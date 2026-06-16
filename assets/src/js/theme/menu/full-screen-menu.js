import { fadeIn, fadeOut, slideDown, slideUp } from "../../lib/utils";

class FullScreenMenu {
  #elements = {
    toggleMenuBtn: document.querySelector(
      "#site-header.full_screen-header .menu-bar"
    ),
  };

  constructor() {
    if (!this.#elements.toggleMenuBtn) {
      return;
    }

    this.#setElements();
    this.#start();
    this.#setupEventListeners();
  }

  #setElements = () => {
    this.#elements = {
      ...this.#elements,
      menu: document.querySelector(
        "#site-header.full_screen-header #full-screen-menu"
      ),
      header: document.querySelector("#site-header.full_screen-header"),
      logo: document.querySelector("#site-logo.has-full-screen-logo"),
      html: document.querySelector("html"),
    };
  };

  #start = () => {
    this.#elements.menu.querySelectorAll(".nav-arrow").forEach((plusBtn) => {
      plusBtn.setAttribute("tabindex", 0);
    });
  };

  #setupEventListeners = () => {
    this.#elements.toggleMenuBtn.addEventListener(
      "click",
      this.#onToggleMenuBtnClick
    );

    document
      .querySelectorAll(
        '#full-screen-menu #site-navigation ul > li.dropdown > a > .text-wrap > span.nav-arrow, #full-screen-menu #site-navigation ul > li.dropdown > a[href="#"]'
      )
      ?.forEach((menuItemLink) => {
        menuItemLink.addEventListener("click", this.#onMenuLinkClick);
        menuItemLink.addEventListener("tap", this.#onMenuLinkClick);
      });

    document
      .querySelectorAll(
        '#full-screen-menu #site-navigation a.menu-link[href*="#"]:not([href="#"])'
      )
      .forEach((menuItemLink) => {
        menuItemLink.addEventListener("click", this.#onMenuHashtagLinkClick);
      });

    document.addEventListener("keydown", this.#onDocumentKeydown);
  };

  #onToggleMenuBtnClick = (event) => {
    event.preventDefault();

    const toggleMenuBtn = event.currentTarget;

    if (!toggleMenuBtn.classList.contains("exit")) {
      this.#openMenu();
    } else {
      this.#closeMenu();
    }
  };

  #onMenuLinkClick = (event) => {
    event.preventDefault();
    event.stopPropagation();

    const menuItemLink = event.currentTarget;
    const menuItem = menuItemLink.closest("li.dropdown");
    const subMenu = menuItem.querySelector("ul.sub-menu");

    if (!(window.getComputedStyle(subMenu).display === "none")) {
      menuItem.classList.remove("open-sub");
      slideUp(subMenu, 250);
    } else {
      menuItem.classList.add("open-sub");
      slideDown(subMenu, 250);
    }
  };

  #onMenuHashtagLinkClick = (event) => {
    this.#closeMenu();
  };

 #openMenu = () => {
    this.#elements.header.classList.add("nav-open");
    this.#elements.toggleMenuBtn.classList.add("exit");
    this.#elements.logo?.classList.add("opened");
    this.#elements.menu.classList.add("active");

    this.#elements.toggleMenuBtn.setAttribute(
      "aria-expanded",
      "true"
    );

    fadeIn(this.#elements.menu);

    const htmlWidthBeforeOverflowHidden =
      this.#elements.html.innerWidth;

    this.#elements.html.style.overflow = "hidden";

    const htmlWidthAfterOverflowHidden =
      this.#elements.html.innerWidth;

    this.#elements.html.style.marginRight =
      htmlWidthBeforeOverflowHidden -
      htmlWidthAfterOverflowHidden +
      "px";

    setTimeout(() => {
      const firstFocusable =
        this.#elements.menu.querySelector(
          'a, button, input, [tabindex="0"]'
        );

      firstFocusable?.focus();
    }, 100);
  };

  #closeMenu = () => {
    this.#elements.header.classList.remove("nav-open");
    this.#elements.toggleMenuBtn.classList.remove("exit");
    this.#elements.logo?.classList.remove("opened");
    this.#elements.menu.classList.remove("active");

    this.#elements.toggleMenuBtn.setAttribute(
      "aria-expanded",
      "false"
    );

    fadeOut(this.#elements.menu);

    this.#elements.html.style.overflow = "";
    this.#elements.html.style.marginRight = "";

    document
      .querySelectorAll(
        "#full-screen-menu #site-navigation ul > li.dropdown"
      )
      .forEach((menuItem) => {
        menuItem.classList.remove("open-sub");
      });

    document
      .querySelectorAll(
        "#full-screen-menu #site-navigation ul.sub-menu"
      )
      .forEach((subMenu) => {
        slideUp(subMenu, 250);
      });

    setTimeout(() => {
      this.#elements.toggleMenuBtn?.focus();
    }, 100);
  };

  /**
   * Trap keyboard navigation in the menu modal.
   */
  #onDocumentKeydown = (event) => {
    if (!this.#elements.menu?.classList.contains("active")) {
      return;
    }

    const tabKey = event.key === "Tab" || event.keyCode === 9;
    const shiftKey = event.shiftKey;
    const escKey = event.key === "Escape" || event.keyCode === 27;
    const enterKey = event.key === "Enter" || event.keyCode === 13;

    const closeIcon = this.#elements.toggleMenuBtn;

    const focusableInside = [
      ...this.#elements.menu.querySelectorAll(
        'a, button, input, [tabindex="0"]'
      ),
    ].filter(
      (element) =>
        element.offsetWidth > 0 ||
        element.offsetHeight > 0 ||
        element.getClientRects().length
    );

    if (!focusableInside.length) {
      return;
    }

    const firstMenuElement = focusableInside[0];
    const lastMenuElement =
      focusableInside[focusableInside.length - 1];

    if (!closeIcon) {
      return;
    }

    closeIcon.style.outline = "";

    // ESC closes menu.
    if (escKey) {
      event.preventDefault();
      this.#closeMenu();
      return;
    }

    // ENTER activates submenu toggle.
    if (
      enterKey &&
      document.activeElement?.classList.contains("nav-arrow")
    ) {
      event.preventDefault();
      document.activeElement.click();
      return;
    }

    if (!tabKey) {
      return;
    }

    // Shift + Tab from trigger -> last menu item.
    if (
      shiftKey &&
      document.activeElement === closeIcon
    ) {
      event.preventDefault();
      lastMenuElement.focus();
      return;
    }

    // Tab from last menu item -> trigger.
    if (
      !shiftKey &&
      document.activeElement === lastMenuElement
    ) {
      event.preventDefault();

      closeIcon.style.outline =
        "1px dashed rgba(255, 255, 255, 0.6)";

      closeIcon.focus();
      return;
    }

    // Shift + Tab from first menu item -> trigger.
    if (
      shiftKey &&
      document.activeElement === firstMenuElement
    ) {
      event.preventDefault();

      closeIcon.style.outline =
        "1px dashed rgba(255, 255, 255, 0.6)";

      closeIcon.focus();
      return;
    }
  };
}

("use script");
window.oceanwp = window.oceanwp || {};
oceanwp.fullScreenMenu = new FullScreenMenu();
