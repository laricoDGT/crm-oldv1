function applyTabsScript(container) {
  if (!container) {
    return;
  }

  const tabsNav = container.querySelector(".tabs-nav");

  tabsNav.addEventListener("click", function (event) {
    const tabsBtn = event.target.closest(".tabs-btn");

    if (tabsBtn) {
      const clickedIndex = Array.from(tabsBtn.parentNode.children).indexOf(
        tabsBtn
      );
      showTab(container, clickedIndex);
      updateURLHash(tabsBtn.id);
    }
  });

  function showTab(container, index) {
    const tabContents = container.querySelectorAll(".tabs-content");
    tabContents.forEach((content) => {
      content.classList.remove("current");
    });

    tabContents[index].classList.add("current");

    const tabs = container.querySelectorAll(".tabs-nav .tabs-btn");
    tabs.forEach((tab) => {
      tab.classList.remove("current");
    });
    tabs[index].classList.add("current");
  }

  function updateURLHash(hash) {
    window.location.hash = hash;
  }

  function checkURLHash() {
    const hash = window.location.hash.substr(1);
    if (hash) {
      const tabBtn = tabsNav.querySelector(`#${hash}`);
      if (tabBtn) {
        const index = Array.from(tabsNav.children).indexOf(tabBtn);
        showTab(container, index);
      }
    }
  }

  checkURLHash();
}

applyTabsScript(document.querySelector(".tabs"));
