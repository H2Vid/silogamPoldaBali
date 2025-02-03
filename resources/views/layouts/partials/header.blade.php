<nav class="sticky top-0 z-10 bg-yellow-300 border-gray-200">
  <div class="mx-auto px-4 bg-transparent backdrop-filter backdrop-blur-3xl">
    <div class="w-full flex items-center justify-between py-4">
      <a class="flex items-center" href="{{ url('/') }}">
        <img class="w-20 h-10 mr-2" alt="Logo" src="{{ asset('assets/images/Indonesia.jpg') }}">
      </a>

      <!-- Menu Navbar (Desktop) -->
      <div class="hidden md:flex space-x-4 bg-red-500 p-2">
        <a href="{{ url('/') }}" class="flex items-center {{ request()->is('/') ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm">
          Beranda
        </a>

        @foreach (Category::getAll() as $category)
          @php
            $subcategories = App\Models\Subcategory::where('category_id', $category->id)->get();
          @endphp
          <div class="relative">
            <div class="flex items-center space-x-2">
              <a href="{{ route('category', ['slug' => $category->slug]) }}" class="{{ request()->is('category/'.$category->slug) ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm">
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
                  <a href="#" class="block py-2 px-4 hover:bg-blue-500 hover:text-white rounded-sm">
                    {{ $subcategory->title }}
                  </a>
                @endforeach
              </div>
            @endif
          </div>
        @endforeach
      </div>

      <!-- Logo Kanan -->
      <div class="hidden md:flex items-center">
        <img class="w-20 h-10 mr-2" alt="Logo" src="{{ asset('assets/images/Indonesia.jpg') }}">
      </div>

      <!-- Tombol Hamburger (Mobile) -->
      <button id="menu-toggle" class="md:hidden p-2 w-10 h-10 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Menu Navbar (Mobile) -->
    <div class="hidden w-full md:hidden" id="mobile-menu">
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
                  <li>
                    <a href="#" class="block py-2 px-4 text-gray-900 hover:bg-blue-500 hover:text-white rounded-sm">
                      {{ $subcategory->title }}
                    </a>
                  </li>
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
