// Fix for debugger pause on refresh - safely handle search functionality
(function() {
  "use strict";
  
  // Wait for DOM to be ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSearchFix);
  } else {
    initSearchFix();
  }
  
  function initSearchFix() {
    try {
      const searchInput = document.getElementById("search-input");
      
      // Check if Alpine.js search component exists - if so, skip old event listeners
      if (!searchInput || searchInput.hasAttribute('x-data')) {
        return;
      }

      const searchButton = document.getElementById("search-button");
      
      if (!searchInput || !searchButton) {
        console.warn('Search input or button not found');
        return;
      }
      
      // Function to focus the search input safely
      function focusSearchInput() {
        try {
          if (searchInput) {
            searchInput.focus();
          }
        } catch (e) {
          console.error('Error focusing search input:', e);
        }
      }
      
      // Add click event listener to the search button
      try {
        searchButton.addEventListener("click", focusSearchInput);
      } catch (e) {
        console.error('Error adding click listener:', e);
      }
      
      // Add keyboard event listener for Cmd+K (Mac) or Ctrl+K (Windows/Linux)
      document.addEventListener("keydown", function(event) {
        try {
          if (!searchInput) return;
          if ((event.metaKey || event.ctrlKey) && event.key === "k") {
            event.preventDefault();
            focusSearchInput();
          }
        } catch (e) {
          console.error('Error in Cmd+K handler:', e);
        }
      });
      
      // Add keyboard event listener for "/" key
      document.addEventListener("keydown", function(event) {
        try {
          if (!searchInput) return;
          if (event.key === "/" && document.activeElement !== searchInput) {
            event.preventDefault();
            focusSearchInput();
          }
        } catch (e) {
          console.error('Error in / key handler:', e);
        }
      });
    } catch (error) {
      console.error('Unexpected error in search fix:', error);
    }
  }
})();
