import { options } from "../../constants";
import { slideDown, slideUp } from "../../lib/utils";
import initAccessibleSubmenus from "../menu/accessible-submenus";

class VerticalHeader {
  #elements = {
    header: document.querySelector(
      "#site-header.vertical-header #site-header-inner"
    ),
  };
  #menuItemsPlusIcon;

  constructor() {
    if (!this.#elements.header) {
      return;
    }

    this.#setElements();
    this.#start();
    this.#setupEventListeners();
  }

  #setElements = () => {
    this.#elements = {
      ...this.#elements,
      toggleMenuBtn: document.querySelector(".vertical-toggle"),
      body: document.body,
    };
  };

  #start = () => {
    if (options.semanticDesktopHeader) {
      initAccessibleSubmenus({
        root: this.#elements.header,
        itemSelector: "li.menu-item-has-children:not(.btn)",
        openClass: "active",
        targetMode: options.verticalHeaderTarget === "link" ? "link" : "button",
        duration: 250,
      });

      this.#menuItemsPlusIcon = [];
    } else {
      this.#elements.header
        .querySelectorAll("li.menu-item-has-children:not(.btn) > a")
        .forEach((menuLink) => {
          menuLink.insertAdjacentHTML(
            "beforeend",
            '<span class="dropdown-toggle" tabindex="0"></span>'
          );
        });

      this.#menuItemsPlusIcon =
        options.verticalHeaderTarget == "link"
          ? this.#elements.header.querySelectorAll(
              "li.menu-item-has-children > a"
            )
          : this.#elements.header.querySelectorAll(".dropdown-toggle");
    }

    new PerfectScrollbar(this.#elements.header, {
      wheelSpeed: 0.5,
      suppressScrollX: false,
      suppressScrollY: false,
    });
  };

  #setupEventListeners = () => {
    if (!options.semanticDesktopHeader) {
      this.#menuItemsPlusIcon.forEach((menuItemPlusIcon) => {
        menuItemPlusIcon.addEventListener("click", this.#onMenuItemPlusIconClick);
        menuItemPlusIcon.addEventListener("tap", this.#onMenuItemPlusIconClick);
      });
    }

    this.#elements.toggleMenuBtn.addEventListener(
      "click",
      this.#onToggleMenuBtnClick
    );

    document.addEventListener("keydown", this.#onDocumentKeydown);
  };

  #onMenuItemPlusIconClick = (event) => {
    event.preventDefault();
    event.stopPropagation();

    const menuItemPlusIcon = event.currentTarget;
    const menuItem =
      options.verticalHeaderTarget == "link"
        ? menuItemPlusIcon.parentNode
        : menuItemPlusIcon.parentNode.parentNode;
    const subMenu = menuItem.lastElementChild;

    if (!menuItem?.classList.contains("active")) {
      menuItem.classList.add("active");
      slideDown(subMenu, 250);
    } else {
      menuItem.classList.remove("active");
      slideUp(subMenu, 250);

      menuItem
        .querySelectorAll(".menu-item-has-children.active")
        ?.forEach((openMenuItem) => {
          openMenuItem.classList.remove("active");
          slideUp(openMenuItem.querySelector("ul"), 250);
        });
    }
  };

  #onToggleMenuBtnClick = (event) => {
    event.preventDefault();

    const isOpening =
      !this.#elements.body.classList.contains("vh-opened");

    if (isOpening) {
      this.#elements.body.classList.add("vh-opened");

      this.#elements.toggleMenuBtn
        .querySelector(".hamburger")
        .classList.add("is-active");

      this.#elements.toggleMenuBtn.setAttribute(
        "aria-expanded",
        "true"
      );

      setTimeout(() => {
        const firstFocusable =
          this.#elements.header?.querySelector(
            'a, button, input, [tabindex="0"]'
          );

        firstFocusable?.focus();
      }, 50);
    } else {
      this.#elements.body.classList.remove("vh-opened");

      this.#elements.toggleMenuBtn
        .querySelector(".hamburger")
        .classList.remove("is-active");

      this.#elements.toggleMenuBtn.setAttribute(
        "aria-expanded",
        "false"
      );

      this.#elements.toggleMenuBtn.focus();
    }
  };

  /**
   * Trap keyboard navigation
   */
  #onDocumentKeydown = (event) => {
    const tabKey =
      event.key === "Tab" || event.keyCode === 9;

    const shiftKey = event.shiftKey;

    const escKey =
      event.key === "Escape" || event.keyCode === 27;

    const enterKey =
      event.key === "Enter" || event.keyCode === 13;

    const toggleButton = this.#elements.toggleMenuBtn;

    const focusableInside = [
      ...this.#elements.header.querySelectorAll(
        "a, button, [role='button'], input"
      ),
    ].filter(
      (element) =>
        element.offsetWidth > 0 ||
        element.offsetHeight > 0 ||
        element.getClientRects().length
    );

    if (!focusableInside.length || !toggleButton) {
      return;
    }

    const firstMenuElement = focusableInside[0];
    const lastMenuElement =
      focusableInside[focusableInside.length - 1];

    toggleButton.style.outline = "";

    if (
      enterKey &&
      document.activeElement?.classList.contains(
        "dropdown-toggle"
      )
    ) {
      event.preventDefault();
      document.activeElement.click();
      return;
    }

    if (
      !this.#elements.body.classList.contains("vh-opened")
    ) {
      return;
    }

    if (escKey) {
      event.preventDefault();
      this.#onToggleMenuBtnClick(event);
      return;
    }

    if (!tabKey) {
      return;
    }

    // Shift+Tab from toggle button → last menu item
    if (
      shiftKey &&
      document.activeElement === toggleButton
    ) {
      event.preventDefault();
      lastMenuElement.focus();
      return;
    }

    // Tab from toggle button → first menu item
    if (
      !shiftKey &&
      document.activeElement === toggleButton
    ) {
      event.preventDefault();
      firstMenuElement.focus();
      return;
    }

    // Tab from last menu item → toggle button
    if (
      !shiftKey &&
      document.activeElement === lastMenuElement
    ) {
      event.preventDefault();

      toggleButton.style.outline =
        "1px dashed rgba(255, 255, 255, 0.6)";

      toggleButton.focus();
      return;
    }

    // Shift+Tab from first menu item → toggle button
    if (
      shiftKey &&
      document.activeElement === firstMenuElement
    ) {
      event.preventDefault();

      toggleButton.style.outline =
        "1px dashed rgba(255, 255, 255, 0.6)";

      toggleButton.focus();
    }
  };
}

("use script");
window.oceanwp = window.oceanwp || {};
oceanwp.verticalHeader = new VerticalHeader();
