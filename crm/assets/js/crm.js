function applyTabsScript(container) {
  container.addEventListener("click", function (event) {
    const tabsBtn = event.target.closest(".tabs-btn");

    if (tabsBtn) {
      const clickedIndex = Array.from(tabsBtn.parentNode.children).indexOf(
        tabsBtn
      );
      const tabContents = container.querySelectorAll(".tabs-content");
      tabContents.forEach((content) => {
        content.classList.remove("current");
      });

      tabContents[clickedIndex].classList.add("current");

      const tabs = container.querySelectorAll(".tabs-nav .tabs-btn");
      tabs.forEach((tab) => {
        tab.classList.remove("current");
      });
      tabsBtn.classList.add("current");
    }
  });
}

function observeDOMChanges() {
  const observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.addedNodes.length > 0) {
        mutation.addedNodes.forEach(function (node) {
          if (node.nodeType === 1 && node.classList.contains("tabs")) {
            applyTabsScript(node);
          }
        });
      }
    });
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true,
  });
}
observeDOMChanges();
