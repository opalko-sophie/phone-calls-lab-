import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { apiUrl } from '../api';

function CatalogPage() {
  const [calls, setCalls] = useState([]);
  const [filteredCalls, setFilteredCalls] = useState([]);
  const [activeFilter, setActiveFilter] = useState('all');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    fetch(apiUrl('/calls'))
      .then((response) => {
        if (!response.ok) {
          throw new Error('Помилка отримання даних');
        }

        return response.json();
      })
      .then((data) => {
        setCalls(data);
        setFilteredCalls(data);
        setLoading(false);
      })
      .catch((error) => {
        console.error('Помилка:', error);
        setError('Не вдалося отримати дані з Laravel API');
        setLoading(false);
      });
  }, []);

  function getCallerName(call) {
    return (
      call.subscriber?.name ||
      call.client ||
      call.name ||
      call.client_name ||
      call.full_name ||
      call.title ||
      'Без імені'
    );
  }

  function filterShort() {
    setFilteredCalls(calls.filter((call) => call.duration <= 5));
    setActiveFilter('short');
  }

  function filterLong() {
    setFilteredCalls(calls.filter((call) => call.duration > 5));
    setActiveFilter('long');
  }

  function resetFilter() {
    setFilteredCalls(calls);
    setActiveFilter('all');
  }

  if (loading) {
    return (
      <div className="page catalog-page">
        <div className="loading-state">Завантаження дзвінків...</div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="page">
        <h1>Каталог дзвінків</h1>
        <p className="error">{error}</p>
      </div>
    );
  }

  return (
    <div className="page catalog-page">
      <section className="catalog-hero">
        <div>
          <p className="eyebrow">Журнал переговорів</p>
          <h1>Каталог дзвінків</h1>
          <p className="lead">
            Переглядайте абонентів, тривалість розмов і швидко відкривайте деталі кожного дзвінка.
          </p>
        </div>

        <div className="catalog-summary">
          <span className="summary-number">{filteredCalls.length}</span>
          <span className="summary-label">дзвінків показано</span>
        </div>
      </section>

      <div className="filter-buttons">
        <button className={activeFilter === 'all' ? 'active' : ''} onClick={resetFilter}>Всі</button>
        <button className={activeFilter === 'short' ? 'active' : ''} onClick={filterShort}>Короткі</button>
        <button className={activeFilter === 'long' ? 'active' : ''} onClick={filterLong}>Довгі</button>
      </div>

      <div className="calls-list">
        {filteredCalls.map((call) => (
          <article className="call-row" key={call.id}>
            <Link className="call-link" to={`/call/${call.id}`}>
              <span className="call-avatar">{getCallerName(call).slice(0, 1).toUpperCase()}</span>
              <span className="call-info">
                <span className="call-name">{getCallerName(call)}</span>
                <span className="call-meta">
                  {call.phone || call.subscriber?.phone || 'Телефон не вказано'}
                  {call.city?.name ? ` · ${call.city.name}` : ''}
                </span>
              </span>
              <span className="call-duration">{call.duration} хв</span>
            </Link>
          </article>
        ))}
      </div>
    </div>
  );
}

export default CatalogPage;
