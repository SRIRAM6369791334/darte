@component('mail::message')

# {{ $offerData['title'] }}

---

{{ $offerData['message'] }}

---

@component('mail::button', ['url' => $offerData['link'] ?? url('/')])
🛍️ Shop Now
@endcomponent

---

<small style="color:#999;">
    You're receiving this because you subscribed to {{ config('app.name') }} newsletter.
    <br>
    Don't want to receive offers?
    <a href="{{ $offerData['unsubscribe_url'] ?? '#' }}" style="color:#999;">Unsubscribe here</a>
</small>

Thanks,<br>
**{{ config('app.name') }}**

@endcomponent
