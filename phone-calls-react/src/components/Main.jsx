import { useEffect, useState } from "react";
import { apiUrl } from "../api";

function Main() {
  const [calls, setCalls] = useState([]);

  useEffect(() => {
    fetch(apiUrl("/calls"))
      .then((res) => res.json())
      .then((data) => setCalls(data))
      .catch((err) => console.error(err));
  }, []);

  return (
    <div style={{ padding: "20px" }}>
      <h1>Список дзвінків</h1>

      {calls.length === 0 ? (
        <p>Немає дзвінків</p>
      ) : (
        <div style={{ display: "flex", gap: "20px", flexWrap: "wrap" }}>
          {calls.map((call) => (
            <div
              key={call.id}
              style={{
                border: "1px solid #ccc",
                padding: "15px",
                borderRadius: "10px",
                width: "250px",
              }}
            >
              <p><b>Телефон:</b> {call.phone}</p>
              <p><b>Тривалість:</b> {call.duration} сек</p>
              <p><b>Ціна:</b> {call.price ?? 0} грн</p>
              <p><b>Дата:</b> {call.call_time}</p>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default Main;
