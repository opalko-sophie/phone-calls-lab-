import { useState } from 'react';

function ContactPage() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: '',
  });

  const [errors, setErrors] = useState({});
  const [successMessage, setSuccessMessage] = useState('');

  function handleChange(event) {
    const { name, value } = event.target;

    setFormData({
      ...formData,
      [name]: value,
    });
  }

  function validateForm() {
    const newErrors = {};

    if (!formData.name.trim()) {
      newErrors.name = 'Введіть ім’я';
    }

    if (!formData.email.includes('@')) {
      newErrors.email = 'Email має містити символ @';
    }

    if (formData.message.trim().length < 10) {
      newErrors.message = 'Повідомлення має містити мінімум 10 символів';
    }

    return newErrors;
  }

  function handleSubmit(event) {
    event.preventDefault();

    const validationErrors = validateForm();

    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      setSuccessMessage('');
      return;
    }

    setErrors({});
    setSuccessMessage('Повідомлення успішно надіслано');

    setFormData({
      name: '',
      email: '',
      message: '',
    });
  }

  return (
    <div className="page">
      <h1>Контакти</h1>
      <p>Заповніть форму зворотного зв’язку.</p>

      <form className="contact-form" onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Ім’я</label>
          <input
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            placeholder="Введіть ім’я"
          />
          {errors.name && <p className="error">{errors.name}</p>}
        </div>

        <div className="form-group">
          <label>Email</label>
          <input
            type="text"
            name="email"
            value={formData.email}
            onChange={handleChange}
            placeholder="Введіть email"
          />
          {errors.email && <p className="error">{errors.email}</p>}
        </div>

        <div className="form-group">
          <label>Повідомлення</label>
          <textarea
            name="message"
            value={formData.message}
            onChange={handleChange}
            placeholder="Введіть повідомлення"
          />
          {errors.message && <p className="error">{errors.message}</p>}
        </div>

        <button type="submit">Надіслати</button>

        {successMessage && <p className="success">{successMessage}</p>}
      </form>
    </div>
  );
}

export default ContactPage;