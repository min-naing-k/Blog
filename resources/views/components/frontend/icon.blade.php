@props(['name'])

@if ($name === 'down-icon')
  <svg
    x-bind:class="{'transform rotate-90 transition duration:500 ease absolute pointer-events-none': show, 'transform -rotate-90 transition duration:500 ease absolute pointer-events-none': !show}"
    {{ $attributes(['class' => 'transform -rotate-90']) }} width="22" height="22"
    viewBox="0 0 22 22">
    <g fill="none" fill-rule="evenodd">
      <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z"></path>
      <path fill="#222" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
    </g>
  </svg>
@endif

@if ($name === 'left-icon')
  <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
    <g fill="none" fill-rule="evenodd">
      <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
      </path>
      <path class="fill-current" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
      </path>
    </g>
  </svg>
@endif
