const { useState, useEffect, useRef } = React;
const { BrowserRouter, Route, Link, useParams } = ReactRouterDOM;

function Navbar() {
  const [categories, setCategories] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [display, setDisplay] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    const timeout = new Promise((_, reject) =>
      setTimeout(() => reject(new Error('Request timed out')), 5000)
    );

    const fetchCategories = fetch('http://localhost/api/categories')
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      });

    Promise.race([timeout, fetchCategories])
      .then(data => {
        setCategories(data);
        setIsLoading(false);
      })
      .catch(error => {
        setError(error.message);
        setIsLoading(false);
      });
  }, []);

  useEffect(() => {
    if(!categories) {
      return;
    }
    setDisplay((
      <nav className="navbar navbar-expand-lg navbar-light bg-light">
        <div className="container-fluid">
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
            <ul className="navbar-nav mr-auto">
              {Array.isArray(categories) && categories.map(category => (
                <li className="nav-item dropdown" key={category.id}>
                  <a className="nav-link dropdown-toggle" href={`/${category.slug}`} id={`navbarDropdown-${category.slug}`}  role="button" data-bs-toggle="dropdown">
                    {category.name}
                  </a>
                  <div className="dropdown-menu" aria-labelledby={`navbarDropdown-${category.slug}`} >
                    {Array.isArray(category.articles) && category.articles.map(article => (
                      <Link className="dropdown-item" to={`/${category.slug}/${article.slug}`} key={article.slug}>
                        {article.title}
                      </Link>
                    ))}
                  </div>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </nav>
    ));
  }, [categories]);
  
  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  if(!display) {
    return '';
  }

  return display;
}

function Carousel ({ children, slideTime, infiniteLoop  }) {
  // children are the content to be displayed in the carousel
  // slideTime is the time interval between slides in milliseconds
  // infiniteLoop is a boolean value that indicates whether the carousel should loop or not

  // use state to keep track of the current slide index
  const [currentSlide, setCurrentSlide] = useState(0);
  const timerRef = useRef(null);

  const stopTimer = () => {
    // clear the previous timer if any
    if (timerRef.current) {
      clearTimeout(timerRef.current);
    }
  }

  const startTimer = () => {
    // set a new timer and store it in the ref
    timerRef.current = setTimeout(() => {
      setIsTransitioning(true);
      setCurrentSlide((prev) => (prev + 1) % children.length); // increment the index and wrap around
    }, slideTime);
  }

  // use useEffect to set up a timer that advances the slide
  useEffect(() => {
    stopTimer();
    startTimer(); // start the timer
    // no need to return a cleanup function since the timer is cleared before setting a new one
  }, [currentSlide, slideTime, children.length]); // update the effect when these dependencies change

  // use state to keep track of the mouse position
  const [mouseX, setMouseX] = useState(null);

  // use state to keep track of the drag direction and distance
  const [dragDirection, setDragDirection] = useState(null);
  const [dragDistance, setDragDistance] = useState(0);

  // use state to keep track of the transition status
  const [isTransitioning, setIsTransitioning] = useState(false);

  // handle mouse down event
  const handleMouseDown = (e) => {
    setMouseX(e.clientX); // record the initial mouse position
    stopTimer(); // stop the timer
  };

  // handle mouse move event
  const handleMouseMove = (e) => {
    if (mouseX !== null) {
      // if the mouse is down
      const diff = e.clientX - mouseX; // calculate the difference between the current and initial mouse positions
      if (diff > 0) {
        // if the mouse is moving to the right
        setDragDirection("right");
        setDragDistance(diff);
      } else if (diff < 0) {
        // if the mouse is moving to the left
        setDragDirection("left");
        setDragDistance(-diff);
      }
    }
  };

  // handle mouse up event
  const handleMouseUp = (e) => {
    setMouseX(null); // reset the mouse position
    if (dragDistance > 100) {
      // if the drag distance is more than 100 pixels
      setIsTransitioning(true); // set the transition status to true
      if (dragDirection === "right") {
        // if the drag direction is right
        setCurrentSlide((prev) => (prev - 1 + children.length) % children.length); // decrement the index and wrap around
      } else if (dragDirection === "left") {
        // if the drag direction is left
        setCurrentSlide((prev) => (prev + 1) % children.length); // increment the index and wrap around
      }
    }
    setDragDirection(null); // reset the drag direction
    setDragDistance(0); // reset the drag distance
    startTimer(); // start the timer again
  };

  // handle transition end event
  const handleTransitionEnd = (e) => {
    setIsTransitioning(false); // set the transition status to false
    if(children.length == 2) {
      // put other slide in front and back of current

    }
    
    if(currentSlide == 0) {
      setCurrentSlide(1);
      children.unshift(children.pop());
    } else if(currentSlide == children.length - 1) {
      setCurrentSlide(currentSlide - 1);
      children.push(children.shift());
    }
    
  };

  const adjustedCurrentSlide = infiniteLoop ? currentSlide + 1 : currentSlide;

  // calculate the offset of the carousel content based on the current slide, drag direction, and drag distance
  const offset =
    -currentSlide * 100 +
    (dragDirection === "right" ? dragDistance : -dragDistance) / 5;

  // clone the first and last items if infiniteLoop is true
  const items = infiniteLoop && children.length
    ? [React.cloneElement(children[children.length - 1], {key : 'first'}), ...children, React.cloneElement(children[0], {key : 'last'})]
    : children;

    // adjust the offset and the current slide index if infiniteLoop is true
  const adjustedOffset = infiniteLoop ? offset - 100 : offset;

  // return the JSX element for the carousel component
  return (
    <div className="carousel-container">
      <div className="carousel-wrapper">
        <div className="carousel-content-wrapper">
          <div
            className="carousel-content"
            style={{
              transform: `translateX(${adjustedOffset}%)`, // apply the offset to the translateX property
              transition: isTransitioning ? "all 250ms linear" : "none", // apply the transition only when transitioning
            }}
            onMouseDown={handleMouseDown}
            onMouseMove={handleMouseMove}
            onMouseUp={handleMouseUp}
            onMouseLeave={handleMouseUp}
            onTransitionEnd={handleTransitionEnd}
          >
            {items}
          </div>
        </div>
      </div>
    </div>
  );
};

Carousel.defaultProps = {
  infiniteLoop: true, // set the default value of infiniteLoop to true
};

// Create a React component for the carousel
function ArticleCarousel() {
  const [articles, setArticles] = useState([]);

  useEffect(() => {
    const url = `http://localhost/api/categories/news`

    fetch(url)
      .then(response => response.json())
      .then(data => {
        setArticles(data.articles || data);
      });
  }, []);
  return (
    <Carousel slideTime={5000}>
        {articles.map(article => (
          <ArticleIcon key={article.slug} article={article} />
      ))}
      </Carousel>
  );
}


function ArticleList() {
  const [articles, setArticles] = useState([]);
  const { categorySlug } = useParams();

  useEffect(() => {
    const url = categorySlug
      ? `http://localhost/api/categories/${categorySlug}`
      : 'http://localhost/api/articles';

    fetch(url)
      .then(response => response.json())
      .then(data => {
        setArticles(data.articles || data);
        // If a category slug is provided, change the title of the page to the category name
        document.title = categorySlug ? data.name : 'Electricity Today';
      });
  }, [categorySlug]);
  return (
    <div>
      <ArticleCarousel />
      {articles.map(article => (
        <ArticleIcon key={article.slug} article={article} />
      ))}
    </div>
  );
}

function ArticleIcon({article}) {
  return (
    <a key={article.slug} className="article icon" href={`/${article.categories[0].slug}/${article.slug}`}>
      <div className="card mb-3" style={{backgroundImage:`url(${article.image})`}}>
        <div className="card-body">
          <h4 className="card-title">
            {article.title}
          </h4>
          <small className="btn btn-secondary">{article.author}</small>
        </div>
      </div>
    </a>
  );
}

function Article() {
  const [article, setArticle] = useState({});
  const { articleSlug } = useParams();

  useEffect(() => {
    fetch(`http://localhost/api/articles/${articleSlug}`)
      .then(response => response.json())
      .then(data => {
        setArticle(data);
        // Change the title of the page to the article title
        document.title = data.title;
      });
  }, [articleSlug]);

  return (
    <article className="article">
      <h2>{article.title}</h2>
      <img src={article.image} alt={article.title} />
      <strong>By {article.author}</strong>
      <p className="content">{article.content}</p>
    </article>
  );
}

function App() {
  return (
    <BrowserRouter>
      <div className="container">
        <Link className="logo" to="/"><img src="https://www.electricity-today.com/wp-content/uploads/et-online-magazine-300x74.jpg" /></Link>
        <Navbar />
        <Route path="/" exact component={ArticleList} />
        <Route path="/:categorySlug" exact component={ArticleList} />
        <Route path="/:categorySlug/:articleSlug" component={Article} />
      </div>
    </BrowserRouter>
  );
}

ReactDOM.render(<App />, document.getElementById('root'));
