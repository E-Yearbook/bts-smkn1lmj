// // fix-search.js (versi yang lebih aman)
// document.addEventListener('alpine:init', () => {
//     // Tunggu Alpine selesai inisialisasi
//     const searchInput = document.getElementById("search-input");
//     if (!searchInput) return;

//     function focusSearch() {
//         searchInput.focus();
//         // Optional: select all text
//         searchInput.select();
//     }

//     // Keyboard shortcuts
//     document.addEventListener("keydown", (e) => {
//         if ((e.metaKey || e.ctrlKey) && e.key === "k") {
//             e.preventDefault();
//             focusSearch();
//         }

//         if (e.key === "/" && document.activeElement !== searchInput) {
//             e.preventDefault();
//             focusSearch();
//         }
//     });
// });
