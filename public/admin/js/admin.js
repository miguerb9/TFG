document.addEventListener("DOMContentLoaded", () => {
  const title = document.getElementById("adminTitle");
  const subtitle = document.getElementById("adminSub");
  const cards = document.getElementById("adminCards");

  // Saludo según la hora
  const hour = new Date().getHours();
  const saludo =
    hour < 12
      ? "¡Buenos días!"
      : hour < 19
      ? "¡Buenas tardes!"
      : "¡Buenas noches!";
  subtitle.textContent = `${saludo} Bienvenido al panel.`;

  // Mostrar todo suavemente
  setTimeout(() => {
    title.style.opacity = 1;
    cards.style.opacity = 1;
  }, 300);

  // Efecto hover + clic en las tarjetas
  document.querySelectorAll(".admin-card").forEach((card) => {
    card.addEventListener(
      "mouseenter",
      () => (card.style.transform = "scale(1.03)")
    );
    card.addEventListener(
      "mouseleave",
      () => (card.style.transform = "scale(1)")
    );
    card.addEventListener(
      "click",
      () => (window.location.href = card.dataset.link)
    );
  });
});
