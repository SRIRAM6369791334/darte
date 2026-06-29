# Lessons Learned

## [Routing_Issue] Laravel Route [login] Not Defined
- **Context**: When using built-in Laravel authentication middleware (`auth`), the middleware automatically redirects unauthenticated users to a named route named `login`. If no route has `->name('login')` attached, Laravel throws a `RouteNotFoundException`.
- **Root Cause**: The application mapped the login page to `/my-account` but did not register it with the route name `login`.
- **Solution**: Added `->name('login')` to the GET `/my-account` route in both `web/routes/web.php` and `website/routes/web.php`.
- **Preventions**: Always ensure that if auth middleware is applied to any route, the target login page route is explicitly named `login` in the routes configuration.

## [UI_Enhancement] Converting Tabbed Content to Accordion
- **Context**: Designed a luxury, collapsible accordion layout using Bootstrap 5 `.accordion` classes to replace old horizontal tabs for product descriptions and details.
- **Implementation**:
  - Embedded CSS rules under the `<style>` block in the blade template to define neat, minimal horizontal dividers, spacing, and custom chevron indicators.
  - Retained all existing dynamic variables (`$product->product_specification`, `$product->reviews`, etc.) intact to avoid breaking data flow.
  - Ensured the chevron rotates smoothly by toggle states (`.collapsed` class rotation).
  - Kept review section target ID (`profile-tab`) active on the header button, preserving original external click triggers.

## [UI_Enhancement] Mobile Responsive Product Details Redesign
- **Context**: Redesigned details grid, quantity stepper, circular sizes, and accordion headers to match a premium visual mockup.
- **Implementation**:
  - Set CSS Grid columns to align Price on the left and Quantity on the right on mobile screens, avoiding centered stacking.
  - Added a grid divider element spanning both columns (`grid-column: 1 / -1`) to cleanly separate layout rows.
  - Reordered accordion items to match the user's hierarchy: DESCRIPTION -> PRODUCT INFO -> SHIPPING & RETURNS.
  - Added custom shopping bag outline icon (`feather icon-shopping-bag`) to the `ADD TO CART` button and styled buttons side-by-side with separate border-radius definitions by removing the `.btn-group` wrapper class.
## [Formatting_Error] Formatter Clash with Blade Route Directive inside JS
- **Context**: When using Blade route helpers like `{{ route('cart.add') }}` inside JavaScript strings, single quotes around the PHP string literal can clash with single quotes around the JS string.
- **Root Cause**: An auto-formatter parses `'{{ route('` as a closed JS string literal, leaving `cart.add` as parsed JS identifiers. It then wraps the line on long lines or spaces, splitting the route call across newlines. Laravel's compilation then looks for a route with newlines and spaces (`\n                cart.add `) which fails.
- **Solution**: Always mismatch quotes between the outer JS string and the inner PHP route name. Use double quotes on the outer JS argument: `fetch("{{ route('cart.add') }}", ...)` or template backticks: `fetch(`{{ route('cart.add') }}`, ...)`.

## [CSS_Override] Overriding Theme Styles with High Specificity
- **Context**: When implementing custom UI designs on top of a pre-built Bootstrap theme, global or component-specific theme styles (like `.btn-quantity .btn` or `.cart-btn .btn`) can override custom inline CSS rules even if they use `!important`.
- **Root Cause**: Specificity calculations (`element.class.class` beats `.class` even with `!important` if the theme also uses `!important` or if the theme sets padding/margins that alter the custom layout).
- **Solution**: Always match or exceed theme selector specificity (e.g. use `.cart-btn #add-to-cart-btn` and `.qty-stepper .qty-btn` instead of just `#add-to-cart-btn` or `.qty-btn`) and reset theme properties like margins and padding (`margin: 0 !important;` or `padding: 0 !important;`) to ensure the custom design renders correctly on all screen resolutions.

