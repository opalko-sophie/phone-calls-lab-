import { useEffect, useState } from 'react';

function CallCard({ id, client, phone, duration }) {
  const storageKey = `call-count-${id}`;

  const [count, setCount] = useState(() => {
    const savedCount = localStorage.getItem(storageKey);
    return savedCount ? Number(savedCount) : 0;
  });

  useEffect(() => {
    localStorage.setItem(storageKey, count);
  }, [storageKey, count]);

  return (
    <div className="card">
      <h3>{client}</h3>
      <p>Телефон: {phone}</p>
      <p>Тривалість: {duration} хв</p>

      <button onClick={() => setCount(count + 1)}>
        Купити
      </button>

      <p>Кількість примірників: {count}</p>
    </div>
  );
}

export default CallCard;