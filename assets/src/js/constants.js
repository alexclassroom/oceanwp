export const options = oceanwpLocalize;

export const DOM = {
    html: document.querySelector("html"),
    body: document.body,
    WPAdminbar: document.querySelector("#wpadminbar"),
    main: document.querySelector("#main"),
    selectTags: document.querySelectorAll(options.customSelects),
    floatingBar: document.querySelector(".owp-floating-bar"),
    header: {
        site: document.querySelector("#site-header"),
        vertical: document.querySelector("#site-header.vertical-header #site-header-inner"),
        fullScreen: document.querySelector("#site-header.full_screen-header"),
        topbar: document.querySelector("#top-bar"),
        topbarWrapper: document.querySelector("#top-bar-wrap"),
        stickyTopbarWrapper: document.querySelector("#top-bar-sticky-wrapper"),
        topLeftSide: document.querySelector("#site-header.top-header .header-top .left"),
        topRightSide: document.querySelector("#site-header.top-header .header-top .right"),
    },
    menu: {
        nav: document.querySelector("#site-header.header-replace #site-navigation"),
        main: document.querySelector(".main-menu"),
        fullScreen: {
            menu: document.querySelector("#site-header.full_screen-header #full-screen-menu"),
            toggleMenuBtn: document.querySelector("#site-header.full_screen-header .menu-bar"),
            logo: document.querySelector("#site-logo.has-full-screen-logo"),
        },
        mega: {
            menuItems: document.querySelectorAll("#site-navigation .megamenu-li.full-mega"),
            topbarMenuItems: document.querySelectorAll("#top-bar-nav .megamenu-li.full-mega"),
            menuContents: document.querySelectorAll(".navigation .megamenu-li.auto-mega .megamenu"),
        },
        vertical: {
            toggleMenuBtn: document.querySelector("a.vertical-toggle"),
        },
    },
    mobileMenu: {
        nav: document.querySelector("#mobile-dropdown > nav"),
        navWrapper: document.querySelector("#mobile-dropdown"),
        toggleMenuBtn: document.querySelector(".mobile-menu"),
        hamburgerBtn: document.querySelector(".mobile-menu > .hamburger"),
        menuItemsHasChildren: document.querySelectorAll("#mobile-dropdown .menu-item-has-children"),
        fullScreen: document.querySelector("#mobile-fullscreen"),
    },
    search: {
        forms: document.querySelectorAll("form.header-searchform"),
        dropDown: {
            toggleSearchBtn: document.querySelector("a.search-dropdown-toggle"),
            form: document.querySelector("#searchform-dropdown"),
        },
        headerReplace: {
            toggleSearchBtn: document.querySelector("a.search-header-replace-toggle"),
            closeBtn: document.querySelector("#searchform-header-replace-close"),
            form: document.querySelector("#searchform-header-replace"),
        },
        overlay: {
            toggleSearchBtn: document.querySelector("a.search-overlay-toggle"),
            closeBtn: document.querySelector("a.search-overlay-close"),
            form: document.querySelector("#searchform-overlay"),
        },
    },
    footer: {
        parallax: document.querySelector(".parallax-footer"),
    },
    scroll: {
        scrollTop: document.querySelector("#scroll-top"),
        goTop: document.querySelector('a[href="#go-top"]'),
        goTopSlash: document.querySelector('body.home a[href="/#go-top"]'),
    },
    blog: {
        masonryGrids: document.querySelectorAll(".blog-masonry-grid"),
    },
    edd: {
        carts: document.querySelectorAll(".edd-menu-icon"),
        overlayCarts: document.querySelectorAll(".owp-cart-overlay"),
        totalPrices: document.querySelectorAll(".eddmenucart-details.total"),
        quickViewModal: document.querySelector("#owp-qv-wrap"),
        quickViewContent: document.querySelector("#owp-qv-content"),
    },
    woo: {
        product: document.querySelector(".woocommerce div.product"),
        allProducts: document.querySelectorAll(".woocommerce ul.products"),
        categories: document.querySelectorAll(".woo-dropdown-cat .product-categories"),
        verticalThumbs: document.querySelectorAll(".owp-thumbs-layout-vertical"),
        navs: document.querySelectorAll(".flex-control-nav"),
        grid: document.querySelector(".oceanwp-grid-list #oceanwp-grid"),
        list: document.querySelector(".oceanwp-grid-list #oceanwp-list"),
        productTabs: document.querySelector(".woocommerce div.product .woocommerce-tabs"),
        productCarts: document.querySelectorAll(".woocommerce div.product .cart"),
        quentity: document.querySelector('input[name="quantity"]'),
        checkoutForm: document.querySelector("form.woocommerce-checkout"),
        checkoutLogin: document.querySelector("#checkout_login"),
        checkoutCoupon: document.querySelector("#checkout_coupon"),
        checkoutTimeline: document.querySelector("#owp-checkout-timeline"),
        customerBillingDetails: document.querySelector("#customer_billing_details"),
        customerShippingDetails: document.querySelector("#customer_shipping_details"),
        customerLogin: document.querySelector("#customer_login"),
        orderReview: document.querySelector("#order_review"),
        orderCheckoutPayment: document.querySelector("#order_checkout_payment"),
        placeOrder: document.querySelector("#place_order"),
        formActions: document.querySelector("#form_actions"),
        overlayCart: document.querySelector(".owp-cart-overlay"),
        accountLinks: document.querySelector(".owp-account-links"),
        quantityInputs: document.querySelectorAll(".quantity:not(.buttons_added) .qty"),
        quickView: {
            modal: document.querySelector("#owp-qv-wrap"),
            content: document.querySelector("#owp-qv-content"),
        },
    },
};

export const DOMString = {};
