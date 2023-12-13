const { useState, useEffect } = React;
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
        <div className="collapse navbar-collapse">
          <ul className="navbar-nav mr-auto">
            {Array.isArray(categories) && categories.map(category => (
              <li className="nav-item dropdown" key={category.id}>
                <a className="nav-link dropdown-toggle" href={`/${category.slug}`} id={`navbarDropdown-${category.slug}`}  role="button" data-bs-toggle="dropdown">
                  {category.name}
                </a>
                <div className="dropdown-menu" aria-labelledby={`navbarDropdown-${category.slug}`} >
                  {Array.isArray(category.articles) && category.articles.map(article => (
                    <Link className="dropdown-item" to={`/${category.slug}/${article.slug}`} key={article.slug}>
                      <{article.title}>
                    </Link>
                  ))}
                </div>
              </li>
            ))}
          </ul>
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
          <small class="btn btn-secondary">{article.author}</small>
        </div>
      </div>
    </a>
  );
}

function Article() {
  const [article, setArticle] = useState({});
  const { articleSlug } = useParams();

  useEffect(() => {
    console.log('Get Article', articleSlug);
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
