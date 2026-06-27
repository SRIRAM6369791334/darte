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
