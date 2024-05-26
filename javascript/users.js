const searchBar = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  searchDiv = document.querySelector(".users .search");
let focusDone = false;
let blurDone = false;

searchBar.addEventListener("focus", (e) => {
  if (!focusDone) {
    searchBtn.classList.add("active");
  }
});
searchBar.addEventListener("blur", (e) => {
  if (!blurDone) {
    searchBtn.classList.remove("active");
  }
});

searchBtn.addEventListener("click", function () {
  getSearchUsersList();
});

searchBar.addEventListener("keyup", getSearchUsersList);

function getSearchUsersList() {
  let searchTerm = searchBar.value;
  if (searchTerm != "") {
    searchDiv.classList.add("active");
  } else {
    searchDiv.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);
        document.querySelector(".users-list").innerHTML = data;
      }
    }
  });

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(`searchTerm=${searchTerm}`);
}

function getUserList() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchDiv.classList.contains("active")) {
          document.querySelector(".users-list").innerHTML = data;
        }
      }
    }
  });

  xhr.send();
}

getUserList();

setInterval(getUserList, 500);
