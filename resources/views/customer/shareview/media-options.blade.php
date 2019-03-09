<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">MEDIA TYPES</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
      <?php $currentroute = @Route::currentRouteName(); ?>
    <ul class="navbar-nav">
      <li class="nav-item @if($currentroute === "customer.upload-image") active @endif">
        <a class="nav-link" href="{{ route('customer.upload-image') }}">IMAGE <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item @if($currentroute === "customer.upload-pdf") active @endif">
        <a class="nav-link" href="{{ route('customer.upload-pdf') }}">PDF <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">DOCX</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">XLXS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">PPTX</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>