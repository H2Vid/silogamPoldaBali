<nav class="sticky bg-cover bg-center h-0 md:h-24 bg-no-repeat top-0 z-20 py-4" style="background-image: url('{{ asset('assets/images/bgnav.png') }}');">
  <div class="mx-auto px-4 ">
    <div class="w-full flex items-top justify-between">
      <a class="flex items-top" href="{{ url('/') }}">
        <img class="w-20 h-10 mr-2 " alt="Logo" src="{{ asset('assets/images/Indonesia.jpg') }}">
      </a>

      <!-- Menu Navbar (Desktop) -->
      <div class="hidden h-10 lg:flex space-x-4">
        <a href="{{ url('/') }}" class=" flex items-center {{ request()->is('/') ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm">
          Beranda
        </a>

        @foreach (Category::getAll() as $category)
          @php
            $subcategories = App\Models\Subcategory::where('category_id', $category->id)->get();
          @endphp
          <div class="relative">
            <div class="flex items-center space-x-2 h-auto">
              <a href="{{ route('category', ['slug' => $category->slug]) }}" class="{{ request()->is('category/'.$category->slug) ? 'bg-blue-500 text-white' : ' text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm  h-10">
                {{ $category->title }}
              </a>

              @if ($subcategories->isNotEmpty())
                <button onclick="toggleDropdown(this)" class="text-white focus:outline-none">
                  ▼
                </button>
              @endif
            </div>

            @if ($subcategories->isNotEmpty())
              <div class="dropdown hidden absolute left-0 mt-2 w-48 bg-white text-black rounded-sm shadow-lg z-10"
                   onmouseleave="hideDropdown(this)">
                   @foreach ($subcategories as $subcategory)
                      @php
                        // Mengubah title menjadi slug
                        $slug = strtolower(str_replace(' ', '-', $subcategory->title));
                      @endphp
                      <a href="{{ url('subcategory/'.$slug) }}" class="block py-2 px-4 hover:bg-blue-500 hover:text-white rounded-sm">
                        {{ $subcategory->title }}
                      </a>
                    @endforeach

              </div>
            @endif
          </div>
        @endforeach
      </div>

      <!-- Logo Kanan -->
      <a href="https://linktr.ee/birosdmpoldabali" class="hidden md:flex md:-mt-7 items-center">
        <img alt="Logo" src="{{ asset('assets/images/contactUS.png') }}" style="width:140px; height: 160px;">
      </a>

      <!-- Tombol Hamburger (Mobile) -->
      <button id="menu-toggle" class="lg:hidden p-2 w-10 h-10 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Menu Navbar (Mobile) -->
    <div class="hidden w-full lg:hidden" id="mobile-menu">
      <ul class="flex flex-col font-medium p-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800">
        <li>
          <a href="{{ url('/') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 dark:text-white">
            Beranda
          </a>
        </li>

        @foreach (Category::getAll() as $category)
          @php
            $subcategories = App\Models\Subcategory::where('category_id', $category->id)->get();
          @endphp
          <li class="relative">
            <div class="flex items-center justify-between">
              <a href="{{ route('category', ['slug' => $category->slug]) }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 dark:text-white">
                {{ $category->title }}
              </a>
              @if ($subcategories->isNotEmpty())
                <button onclick="toggleMobileDropdown(this)" class="text-gray-500 focus:outline-none">
                  ▼
                </button>
              @endif
            </div>
            @if ($subcategories->isNotEmpty())
              <ul class="mobile-dropdown hidden pl-4 bg-gray-200 rounded-md mt-1">
              @foreach ($subcategories as $subcategory)
                  @php
                    // Mengubah title menjadi slug
                    $slug = strtolower(str_replace(' ', '-', $subcategory->title));
                  @endphp
                  <a href="{{ url('subcategory/'.$slug) }}" class="block py-2 px-4 hover:bg-blue-500 hover:text-white rounded-sm">
                    {{ $subcategory->title }}
                  </a>
                @endforeach

              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</nav>

<!-- JavaScript -->
<script>
  function toggleDropdown(button) {
    document.querySelectorAll('.dropdown').forEach(dropdown => {
      if (dropdown !== button.parentElement.nextElementSibling) {
        dropdown.classList.add('hidden');
      }
    });

    let dropdown = button.parentElement.nextElementSibling;
    dropdown.classList.toggle("hidden");
  }

  function hideDropdown(dropdown) {
    dropdown.classList.add("hidden");
  }

  // Menu Hamburger (Mobile)
  document.getElementById('menu-toggle').addEventListener('click', function () {
    let menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });

  function toggleMobileDropdown(button) {
    let dropdown = button.parentElement.nextElementSibling;
    dropdown.classList.toggle("hidden");
}
</script>