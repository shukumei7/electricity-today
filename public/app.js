const { useState, useEffect } = React;
const { BrowserRouter, Route, Link, useParams } = ReactRouterDOM;
function Navbar() {
  const [categories, setCategories] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
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
  
  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <Link className="navbar-brand" to="/">Logo</Link>
      <div className="collapse navbar-collapse">
        <ul className="navbar-nav mr-auto">
          {Array.isArray(categories) && categories.map(category => (
            <li className="nav-item dropdown" key={category.id}>
              <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                {category.name}
              </a>
              <div className="dropdown-menu">
                {Array.isArray(category.items) && category.items.map(item => (
                  <Link className="dropdown-item" to={`/${item.slug}`} key={item.id}>
                    {item.name}
                  </Link>
                ))}
              </div>
            </li>
          ))}
        </ul>
      </div>
    </nav>
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
      {articles.map(article => (
        <div key={article.id}>
          <a href={`/${article.categories[0].slug}/${article.slug}`}>
            {article.title}
          </a>
          <p>
            {article.summary}
          </p>
        </div>
      ))}
    </div>
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
    <div>
      <h2>{article.title}</h2>
      <p>{article.content}</p>
    </div>
  );
}

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Route path="/" exact component={ArticleList} />
      <Route path="/:categorySlug" exact component={ArticleList} />
      <Route path="/:categorySlug/:articleSlug" component={Article} />
    </BrowserRouter>
  );
}

ReactDOM.render(<App />, document.getElementById('root'));
