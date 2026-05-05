import { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import { apiUrl } from '../api';

function CallDetails() {
  const { id } = useParams();
  const [call, setCall] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    fetch(apiUrl(`/calls/${id}`))
      .then((response) => {
        if (!response.ok) {
          throw new Error('Дзвінок не знайдено');
        }

        return response.json();
      })
      .then((data) => {
        setCall(data);
        setLoading(false);
      })
      .catch((error) => {
        console.error('Помилка:', error);
        setError('Не вдалося завантажити деталі дзвінка');
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return (
      <div className="page details-page">
        <div className="loading-state">Завантаження деталей...</div>
      </div>
    );
  }

  if (error || !call) {
    return (
      <div className="page details-page">
        <Link className="back-link" to="/catalog">Назад до каталогу</Link>
        <h1>Дзвінок не знайдено</h1>
        <p className="error">{error}</p>
      </div>
    );
  }

  const callerName = call.subscriber?.name || call.client || call.name || 'Без імені';
  const phone = call.phone || call.subscriber?.phone || 'Телефон не вказано';

  return (
    <div className="page details-page">
      <Link className="back-link" to="/catalog">Назад до каталогу</Link>
      <section className="details-panel">
        <p className="eyebrow">Деталі дзвінка</p>
        <h1>{callerName}</h1>

        <div className="details-grid">
          <div>
            <span>Телефон</span>
            <strong>{phone}</strong>
          </div>
          <div>
            <span>Тривалість</span>
            <strong>{call.duration} хв</strong>
          </div>
          <div>
            <span>Місто</span>
            <strong>{call.city?.name || 'Не вказано'}</strong>
          </div>
          <div>
            <span>Вартість</span>
            <strong>{call.price ? `${call.price} грн` : 'Не вказано'}</strong>
          </div>
        </div>
      </section>
    </div>
  );
}

export default CallDetails;
