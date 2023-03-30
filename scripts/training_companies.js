console.log("training_companies");

let container = document.querySelector('#search-apprenticeship-companies-container');
let filterButton = document.querySelector('#filter-search-table');
let filterReset = document.querySelector('#filter-reset');
let filterWhereInput = document.querySelector('#filter-where-input');
let filterTermInput = document.querySelector("#filter-term-input");
let filterCnameInput = document.querySelector("#filter-company-input");
let filterSkillInput = document.querySelector("#filter-skill-input");
let filterRadius = document.querySelector("#filter-radius-input");
let geolocationModal = new bootstrap.Modal(document.getElementById('geolocation-modal'))
const spinner = `
<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
`;
const urlParams = new URLSearchParams(window.location.search);
let query = Object.fromEntries(urlParams.entries())
if (query.home) {
  if (query.skill) filterSkillInput.value = query.skill
  if (query.term) filterTermInput.value = query.term
  if (query.radius) filterRadius.value = query.radius
  if (query.city) filterWhereInput.value = query.city
}

// 
window.search_page = 1;
window.filter_city = '';
window.filter_term = '';
window.filter_cname = '';
window.filter_skill = ''
window.filter_radius = 0;

window.filter_user_lat = '';
window.filter_user_lng = '';

let search_endpoint = 'api/compaines_filter.php';

function getSearchEndpoint() {
  return `${search_endpoint}?page=${window.search_page}&skill=${window.filter_skill}&cname=${window.filter_cname}&city=${window.filter_city}&term=${window.filter_term}&radius=${window.filter_radius ? window.filter_radius : 0}&user_lat=${window.filter_user_lat}&user_lng=${window.filter_user_lng}`;
}





window.rebuildTable = function () {
  container.innerHTML = spinner;
  scrollIntoFirstResult()
  fetch(getSearchEndpoint()).then(response => response.json()).then(response => {
    container.innerHTML = buildTable(response.cols, response.result, response.pages)
  })
}

function scrollIntoFirstResult() {
  container.scrollIntoView({ inline: 'start' });
}


filterReset.onclick = function () {
  filterWhereInput.value = '';
  filterTermInput.value = '';
  filterCnameInput.value = '';
  filterSkillInput.value = '';
  filterRadius.value = null;
  filterButton.click()
}

filterButton.onclick = function () {
  window.filter_city = filterWhereInput.value;
  window.filter_term = filterTermInput.value;
  window.filter_cname = filterCnameInput.value;
  window.filter_radius = filterRadius.value;
  window.filter_skill = filterSkillInput.value;
  window.search_page = 1;
  container.innerHTML = spinner;
  scrollIntoFirstResult()
  fetch(getSearchEndpoint()).then(response => response.json()).then(response => {
    container.innerHTML = buildTable(response.cols, response.result, response.pages)
    window.history.pushState({}, document.title, window.location.pathname);
  })
}

function buildTable(cols = [], data = [], pages = 0,) {
  // console.log(data);
  let table = `<div>`;
  data.forEach(post => {
    table += `<div class="d-flex text-start my-5 gap-2 post-search-result-row shadow p-2">`
    table += `<img width='80px' hieght='80px' src="/${post.post_image}" />`
    table += `<div class="">`
    table += `<p><strong>Title: </strong>${post.post_title}</p>`
    table += `<p><strong>Company: </strong>${post.company_name}</p>`
    table += `<p><strong>Skill: </strong>${post.post_skill}</p>`
    table += `<p><strong>City: </strong>${post.post_city}</p>`
    table += `<p><strong>Distance: </strong><strong class='text-success'>${post.distance}km</strong></p>`
    table += '</div>'
    table += '</div>'
  })

  table += '</div>'


  // start pages 
  let pages_numbers = `
  <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group me-2" role="group" aria-label="First group">
  `;
  for (let index = 0; index < pages; index++) {
    pages_numbers += `<button 
                          type="button" 
                          class="btn btn-outline-secondary ${(index + 1) == window.search_page ? ' active ' : ''}" 
                          onclick='window.search_page=${(index + 1)};window.rebuildTable()'
                          >
                          ${index + 1}
                       </button>`;
  }
  // close pages number 
  pages_numbers += '</div></div>'
  table += pages_numbers;
  return table;
}


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      // console.log(position);
      let lat = position.coords.latitude;
      let lng = position.coords.longitude;
      window.filter_user_lat = lat;
      window.filter_user_lng = lng;
      container.innerHTML = spinner;
      if (query.home) return filterButton.click();
      fetch(getSearchEndpoint()).then(response => response.json()).then(response => {
        container.innerHTML = buildTable(response.cols, response.result, response.pages)

      })

    }, (err) => {
      //"User denied Geolocation" or "Somthing Wrong" will git coordiante via ip address in server side 
      // geolocationModal.show()
      console.error(err);
      container.innerHTML = spinner;
      if (query.home) return filterButton.click();
      fetch(getSearchEndpoint()).then(response => response.json()).then(response => {
        container.innerHTML = buildTable(response.cols, response.result, response.pages)

      })
    });
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

getLocation();





