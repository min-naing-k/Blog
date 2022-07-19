<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- name slot --}}
  {{-- <title>{{ $title }}</title> --}}
  <title>Blogs</title>

  {{-- Tailwind Css --}}
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />

  {{-- Font Family --}}
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />

  {{-- Alpine Js --}}
  <script src="//unpkg.com/alpinejs" defer></script>

  {{-- Fontawesome --}}
  <script src="https://kit.fontawesome.com/741efb391b.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/css/style.css">
</head>

<style>
  html {
    scroll-behavior: smooth;
  }

</style>

<body style="font-family: Open Sans, sans-serif">
  <section class="px-6 py-8">
    <x-frontend.navbar />
    {{-- Default Slot (only one) --}}
    {{ $slot }}
    <x-frontend.footer />
  </section>

  <x-frontend.flash />
  <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
  <script>
    function openPopover(event, tooltipID) {
      let element = event.target;
      while (element.nodeName !== "BUTTON") {
        element = element.parentNode;
      }
      var popper = Popper.createPopper(
        element,
        document.getElementById(tooltipID), {
          placement: "top",
        }
      );
      document.getElementById(tooltipID).classList.toggle("hidden");
    }
  </script>
</body>

</html>
