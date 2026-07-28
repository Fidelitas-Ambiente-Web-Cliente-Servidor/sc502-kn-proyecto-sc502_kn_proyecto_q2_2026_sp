// document.addEventListener("DOMContentLoaded", () => {
//   // Cargar Navbar desde shared
//   fetch('shared/navbar.html')
//     .then(response => {
//       if (!response.ok) throw new Error('Error cargando el navbar');
//       return response.text();
//     })
//     .then(htmlContent => {
//       const navPlaceholder = document.getElementById('navbar-placeholder');
//       if (navPlaceholder) {
//         navPlaceholder.innerHTML = htmlContent;

//         let paginaActual = window.location.pathname.split('/').pop() || 'index.html';
//         const links = navPlaceholder.querySelectorAll('.nav-link');

//         links.forEach(link => {
//           link.classList.remove('active');
//           if (link.getAttribute('href') === paginaActual) {
//             link.classList.add('active');
//           }
//         });
//       }
//     })
//     .catch(err => console.error("Fallo cargando el navbar: ", err));

//   fetch('shared/footer.html')
//     .then(response => {
//       if (!response.ok) throw new Error('Error cargando el footer');
//       return response.text();
//     })
//     .then(htmlContent => {
//       const footerPlaceholder = document.getElementById('footer-placeholder');
//       if (footerPlaceholder) {
//         footerPlaceholder.innerHTML = htmlContent;
//       }
//     })
//     .catch(err => console.error("Fallo cargando el footer: ", err));
// });