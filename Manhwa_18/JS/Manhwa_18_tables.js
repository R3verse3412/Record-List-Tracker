document.addEventListener('DOMContentLoaded', function() {
  const filterInput = document.getElementById('filter-search');
  const entriesDropdown = document.getElementById('entries-dropdown');
  const prevButton = document.getElementById('prev-button');
  const nextButton = document.getElementById('next-button');
  const manhwa_18Container = document.getElementById('manhwa_18-container');
  const manhwa_18Cards = document.querySelectorAll('.manhwa_18-card');
  let currentPage = 1;
  let entriesPerPage = parseInt(entriesDropdown.value);

  function filterManhwa() {
      const filterValue = filterInput.value.toLowerCase();
      return Array.from(manhwa_18Cards).filter(card => {
          const title = card.querySelector('.text-title').textContent.toLowerCase();
          const year = card.querySelector('.text-year').textContent.toLowerCase();
          return title.includes(filterValue) || year.includes(filterValue);
      });
  }

  function renderPage() {
      const filteredCards = filterManhwa();
      const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
      currentPage = Math.min(currentPage, totalPages || 1);

      manhwa_18Cards.forEach(card => card.style.display = 'none');
      
      filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
          .forEach(card => card.style.display = 'block');

      prevButton.disabled = currentPage === 1;
      nextButton.disabled = currentPage === totalPages || totalPages === 0;
  }

  filterInput.addEventListener('input', function() {
      currentPage = 1;
      renderPage();
  });

  entriesDropdown.addEventListener('change', function() {
      entriesPerPage = parseInt(this.value);
      currentPage = 1;
      renderPage();
  });

  prevButton.addEventListener('click', function() {
      if (currentPage > 1) {
          currentPage--;
          renderPage();
      }
  });

  nextButton.addEventListener('click', function() {
      const filteredCards = filterManhwa();
      const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
      if (currentPage < totalPages) {
          currentPage++;
          renderPage();
      }
  });

  renderPage(); // Call renderPage initially to set up the initial view

  // Event listener for opening the modal
  const manhwa18Modal = document.getElementById('manhwa_18Modal');
  manhwa18Modal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const title = button.getAttribute('data-title');
      const author = button.getAttribute('data-author');
      const description = button.getAttribute('data-description');
      const genre = button.getAttribute('data-genre');
      const rating = button.getAttribute('data-rating');
      const release_date = button.getAttribute('data-release_date');
      const img = button.getAttribute('data-img');
      const status = button.getAttribute('data-status');

      const modal = this;
      modal.querySelector('#manhwa_18Title').textContent = title;
      modal.querySelector('#manhwa_18Author').textContent = author;
      modal.querySelector('#manhwa_18Description').textContent = description;
      modal.querySelector('#manhwa_18Genre').textContent = genre;
      modal.querySelector('#manhwa_18Rating').textContent = rating;
      modal.querySelector('#manhwa_18Release_Date').textContent = release_date;
      modal.querySelector('#manhwa_18Image').src = img;
      modal.querySelector('#manhwa_18Status').textContent = status;
  });
});