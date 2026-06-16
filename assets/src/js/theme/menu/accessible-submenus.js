import { slideDown, slideUp } from "../../lib/utils";

export default function initAccessibleSubmenus(config = {}) {
  const settings = {
    root: null,
    itemSelector: "li.menu-item-has-children",
    submenuSelector: "ul.sub-menu",
    toggleSelector: "button.dropdown-toggle, button.oceanwp-sub-menu-toggle",
    openClass: "active",
    duration: 250,
    targetMode: "icon",
    closeDescendants: true,
    ...config,
  };

  if (!settings.root) {
    return;
  }

  const items = Array.from(settings.root.querySelectorAll(settings.itemSelector));

  items.forEach((item) => {
    setupItem(item, settings);
  });
}

function setupItem(item, settings) {
  const submenu = getDirectChild(item, settings.submenuSelector);

  if (!submenu) {
    return;
  }

  ensureSubmenuId(submenu, item);

  const button = getDirectChild(item, settings.toggleSelector);
  const parentLink = getDirectChild(item, "a");

  if (button) {
    button.setAttribute("type", "button");
    button.setAttribute("aria-controls", submenu.id);
    button.setAttribute("aria-expanded", isOpen(item, settings) ? "true" : "false");

    button.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      toggleItem(item, submenu, settings);
    });
  }

  if (settings.targetMode === "link" && parentLink) {
    parentLink.setAttribute("aria-controls", submenu.id);
    parentLink.setAttribute("aria-expanded", isOpen(item, settings) ? "true" : "false");

    parentLink.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      toggleItem(item, submenu, settings);
    });
  }
}

function toggleItem(item, submenu, settings) {
  if (isOpen(item, settings)) {
    closeItem(item, submenu, settings);

    if (settings.closeDescendants) {
      closeDescendants(item, settings);
    }

    return;
  }

  openItem(item, submenu, settings);
}

function openItem(item, submenu, settings) {
  item.classList.add(settings.openClass);
  item.classList.add("open-sub");

  setExpanded(item, "true", settings);

  slideDown(submenu, settings.duration);
}

function closeItem(item, submenu, settings) {
  item.classList.remove(settings.openClass);
  item.classList.remove("open-sub");

  setExpanded(item, "false", settings);

  slideUp(submenu, settings.duration);
}

function closeDescendants(item, settings) {
  const openItems = item.querySelectorAll(
    `${settings.itemSelector}.${settings.openClass}, ${settings.itemSelector}.open-sub`
  );

  openItems.forEach((childItem) => {
    const submenu = getDirectChild(childItem, settings.submenuSelector);

    if (!submenu) {
      return;
    }

    closeItem(childItem, submenu, settings);
  });
}

function setExpanded(item, value, settings) {
  const button = getDirectChild(item, settings.toggleSelector);
  const parentLink = getDirectChild(item, "a");

  if (button) {
    button.setAttribute("aria-expanded", value);
  }

  if (settings.targetMode === "link" && parentLink) {
    parentLink.setAttribute("aria-expanded", value);
  }
}

function isOpen(item, settings) {
  return item.classList.contains(settings.openClass) || item.classList.contains("open-sub");
}

function getDirectChild(item, selector) {
  return Array.from(item.children).find((child) => child.matches?.(selector)) || null;
}

function ensureSubmenuId(submenu, item) {
  if (submenu.id) {
    return;
  }

  const itemId = item.id ? item.id.replace("menu-item-", "") : Math.random().toString(36).slice(2);

  submenu.id = `oceanwp-sub-menu-${itemId}`;
}
