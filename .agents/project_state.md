# Project State

## Current Context
- **Active Task**: Redesigned my-account (login) and registration pages into a balanced centered Dual-Pane Card Layout on desktop viewports.
- **Application Components**:
  - `website`: Main Laravel application for the web store.
  - `dash`: Admin dashboard.

## Milestones
- [x] Identify mapping of login page (mapped to `/my-account`).
- [x] Update `routes/web.php` to define route name `login`.
- [x] Verify routing compilation with `php artisan route:list`.
- [x] Convert shop details product description tabs into a premium luxury accordion.
- [x] Move accordion to the right column below SKU and Category.
- [x] Redefine CSS styles for product details, stepper, sizes, action buttons, and accordion.
- [x] Refactor HTML structure of details grid, separate action buttons, and reorder accordions.
- [x] Align desktop layout and details grid with mobile view design system using high-specificity selectors to prevent theme overrides.
- [x] Configure desktop grid to stack Quantity section vertically below Price (left-aligned) while keeping side-by-side on mobile.
- [x] Verify view compilation with `php artisan view:clear`.
- [x] Update Instagram image validation dimension constraints from 480x480 to 480x600 in `HomePromotionController.php`.
- [x] Update frontend JustValidate JS constraints and messages in `HomePromotionsPage.js` to enforce 480x600 dimensions.
- [x] Modify text hints in dashboard view modal template `home_promotions.blade.php` to show `*(Rec: 480x600)`.
- [x] Fix JustValidate console warning in `HomePromotionsPage.js` by converting custom async validators to return a function returning a Promise.
- [x] Hide the 'Discover New Arrivals' editorial card on mobile/tablet (screen size < 992px) to match the 'Our best sellers' layout.
- [x] Expand the 'Discover New Arrivals' product swiper carousel to full-width on mobile/tablet.
- [x] Align the 'Discover New Arrivals' Swiper breakpoints with the 'Our best sellers' swiper configuration (1 slide on mobile, 2 slides on tablet/small screens).
- [x] Align and fix search input field and magnifying glass button on mobile header to center vertically and remove vertical divider borders in `header.blade.php`.
- [x] Hide the category dropdown's native select element and `:after` vertical separator line on mobile/tablet search area in `header.blade.php`.
- [x] Set a matching 50px height and flex centering on the category dropdown selector to align it symmetrically with the search input in `header.blade.php`.
- [x] Optimize testimonials section (`section.about-style4`) vertical spacing by reducing section padding and capping image height with `object-fit: cover` to prevent container stretching.
- [x] Replace `iconly-Broken-Buy` with `iconly-Light-Buy` in `header.blade.php` to fix shopping cart icon appearance and match other header icons.
- [x] Hide the "Add To Wishlist" button text on mobile/tablet viewports using `d-none d-md-inline` responsive helper inside `shop-details.blade.php`.
- [x] Set the mobile wishlist button to a square shape (matching its height) and configure the "Add to Cart" button to take the remaining flex width, resolving a CSS selector specificity override issue.
- [x] Replace the wishlist button's feather heart icon with the premium `iconly-Light-Heart2` icon (matching the header wishlist icon) inside `shop-details.blade.php`.
- [x] Justify text layout across all product details description and accordion sections inside `shop-details.blade.php`.
- [x] Apply global text justification styles in `header.blade.php` targeting About Us content (`.about-content p`, `.about-content li`), policy page contents (`.content-box p`, `.content-box li`), reviews (`.comment-content p`), and left-aligned section heads.
- [x] Adjust the testimonial swiper navigation buttons (`.swiper-five .pagination-align`) vertical position on mobile viewports to prevent border overlap in `home.blade.php`.
- [x] Optimize testimonial white spaces on mobile by reducing card bottom padding to 65px, adjusting navigation bottom offset to 15px, and setting swiper margin-bottom to 0px in `home.blade.php`.
- [x] Enforce equal height on all testimonial cards using CSS Flexbox on `.swiper-five` and align all author info blocks at the bottom with `margin-top: auto`.
- [x] Fix mobile layout bugs on the account profile page by stacking navbar toggles and user profile details vertically, and adding wrapping rules to prevent long email address overflow.
- [x] Fix mobile banner content overflow and breadcrumb overlap bugs globally across all views by dynamically managing `.dz-bnr-inr` padding and heights on mobile viewports.
- [x] Fix banner breadcrumb overlap specifically on the account profile page by removing inline padding and adding custom media queries directly in `account-profile.blade.php`.
- [x] Apply the same banner fix (remove inline `padding-top: 200px`, add local `@media (max-width: 767px)` overrides) to all remaining account/order pages: `account-address.blade.php`, `account-order.blade.php`, `account-order-details.blade.php`, `order-cancel.blade.php`, and `order-return.blade.php`.
- [x] Fix coupon edit modal failing to open after a dynamic update by removing trailing " data" from data-bs-target in `CouponsPage.js`.
- [x] Restrict phone number input on the account profile page to digits only using an inline JavaScript regex filter on input.
- [x] Check all other phone number input fields in the `website/resources` views directory and add numeric-only filters (in `account-address.blade.php`, `checkout.blade.php`, and `registration.blade.php`).





- [x] Justify text layout across five policy/info pages: `tracking-returns.blade.php`, `thankyou.blade.php`, `terms-conditions.blade.php`, `privacy-policy.blade.php`, and `cookies-policy.blade.php`.
- [x] Apply global CSS overrides to restore bullet lists (`disc`), decimal numbers (`decimal`), indentations, line heights (`1.7`), heading margins, and font sizes across all informational policy pages.













- [x] Update footer layout to stack 'Quick Links' and 'Our Policies' columns vertically and center-align contents on mobile viewports.
- [x] Convert size selectors in shop-details.blade.php from circles to square-like rounded buttons on mobile viewports.
- [x] Configure "We Accept" text to stack centered above the payment icons on mobile/tablet viewports and hide its colon symbol on mobile in footer.blade.php.
- [x] Implement centered Dual-Pane Card Layout (Option 1) on both login (my-account) and registration pages for desktop to balance page height and remove whitespace.
- [x] Reduce SweetAlert2 title font-size to 22px to improve readability of error/success alert messages.
- [x] Adjust padding and margins on the my-account and registration sections, specifically increasing the top padding (100px on mobile, 140px on desktop) to prevent the transparent absolute header from overlapping and cutting off the top of the cards.
- [x] Fix checkout page critical logic bug by validating courier selection before Razorpay payment initialization in `checkout.blade.php`.
- [x] Return 'already in cart' response from `CartController.php` instead of updating quantity when item is clicked again.
- [x] Sync wishlist and cart icon colors/active states dynamically on the frontend via `updateHeaderCounts` in `app.blade.php`.
- [x] Redirect user to the cart page after a 3-second delay upon successful cart addition or 'already in cart' alert.
- [x] Update details page buttons text dynamically on variant/size selection (ADD TO CART -> ALLREDY CART, ADD TO WISHLIST -> ALLREDY WISHLIST).
- [x] Fix category filter tags, sidebar category links to preserve query params, convert size filter to checkboxes, and pass variant ID to addToCart/addToWishlist in `shop.blade.php`.
- [x] Fix active size tag rendering crash when size is an array on the shop page.
- [x] Allow out of stock button interaction and trigger SweetAlert 'Out of Stock' alert instead of disabling on the details page.
- [x] Allow out of stock button interaction and trigger SweetAlert 'Out of Stock' alert on shop listing page product cards.

