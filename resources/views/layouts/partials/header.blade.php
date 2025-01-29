<nav class="sticky top-0 z-10 bg-transparent backdrop-filter backdrop-blur-3xl border-b border-gray-200">
  <div class="max-w-5xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <!-- Logo dan Menu untuk Desktop -->
      <div class="flex items-center space-x-4 text-white">
        <a class="flex items-center justify-between" href="{{ url('/') }}">
          <img class="w-20 h-10 mr-2" alt="Logo" src="{{ asset('assets/images/indonesia.jpg') }}">
        </a>
        <div class="hidden md:flex space-x-4">
        <a href="{{ url('/') }}" class="flex items-center {{ request()->is('/') ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm">
  Beranda
</a>

          @foreach (Category::getAll() as $category)
          <a href="{{ route('category', ['slug' => $category->slug]) }}" class="{{ request()->is('category/'.$category->slug) ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} block py-2 px-3 rounded-sm">
  {{ $category->title }}
</a>

          @endforeach
          <a href="{{ route('category', ['slug' => 'all']) }}"
   class="flex items-center {{ request()->is('category/all') ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500 ' }} block py-2 px-3 rounded-sm">
  Article
</a>

        </div>

      </div>

      <!-- Tombol Hamburger untuk Mobile -->
      <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Menu Mobile -->
    <div class="hidden w-full md:hidden" id="navbar-dropdown">
      <ul class="flex flex-col font-medium p-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="{{ url('/') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent">
            Beranda
          </a>
        </li>
        @foreach (Category::getAll() as $category)
          <li>
            <a href="{{ route('category', ['slug' => $category->slug]) }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
              {{ $category->title }}
            </a>
          </li>
        @endforeach
        <li>
          <a href="{{ url('/article') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent">
            Article
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
