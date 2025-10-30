//contacto.php
document.addEventListener("DOMContentLoaded", function () {
  const botones = document.getElementsByClassName("info-btn");
  const contenedor = document.getElementById("infoSection");

  const secciones = {
    quienes: `
      <h3>🏅 ¿Quiénes somos?</h3>
      <p>Somos una plataforma creada para facilitar la reserva de pistas deportivas de pádel, tenis, fútbol y baloncesto.</p>
      <p>Nuestra misión es conectar a los usuarios con las mejores instalaciones deportivas de forma rápida, cómoda y online.</p>
    `,
    donde: `
      <h3>📍 Dónde encontrarnos</h3>
      <p>Nos encontramos en las instalaciones del <strong>Centro Deportivo Municipal</strong> de Jerez.</p>
      <p>Dirección: Calle Desengaño, 21 - Jerez</p>
      <p>Horario: Lunes a Domingo · 8:00 - 22:00</p>
      <!-- Mapa -->
      <div class="mt-5 text-center">
      <iframe 
      src="https://www.google.com/maps/embed?pb=!1m27!1m12!1m3!1d25595.639051667302!2d-6.1229853499999995!3d36.68760565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m12!3e6!4m4!1s0xd0dc6e84844a39f%3A0x6dac3ef5f3d0ffea!3m2!1d36.6850064!2d-6.126074399999999!4m5!1s0xd0dc6e84844a39f%3A0x6dac3ef5f3d0ffea!2sJerez%20de%20la%20Frontera%2C%20C%C3%A1diz!3m2!1d36.6850064!2d-6.126074399999999!5e0!3m2!1ses!2ses!4v1760376320388!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      width="100%" height="300" style="border:0;" allowfullscreen loading="lazy">
      </div>
      </iframe>
    `,
    equipo: `
      <h3>👨‍💻 Nuestro equipo</h3>
      <p>Somos un grupo de apasionados del deporte y la tecnología, comprometidos en mejorar tu experiencia deportiva.</p>
      <p>Desde desarrolladores hasta entrenadores, trabajamos juntos para ofrecerte el mejor servicio posible.</p>
    `,
  };

  Array.from(botones).forEach(function (boton) {
    boton.addEventListener("click", function () {
      const id = boton.dataset.section;
      contenedor.innerHTML = secciones[id] || "<h3>Sección no disponible</h3>";

      // Animación visual
      contenedor.classList.add("fade-in");
      setTimeout(() => contenedor.classList.remove("fade-in"), 400);
    });
  });
});
