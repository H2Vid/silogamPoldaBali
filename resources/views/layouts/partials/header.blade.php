<nav class="sticky top-0 z-10 bg-transparent backdrop-filter backdrop-blur-3xl border-b border-gray-200">
  <div class="max-w-5xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
        <div class="flex space-x-4 items-center justify-center text-white">
        <a class="flex items-center justify-between" href="{{ url('/') }}"><img class="w-20 h-10 mr-2" alt="Logo" src="{{ asset('assets/images/indonesia.jpg')}}" >Beranda</a>
        @foreach (Category::getAll() as $category)
          <a href="{{ route('category', ['slug' => $category->slug]) }}" class="hover:text-blue-500">
            {{ $category->title }}
          </a>
        @endforeach
      </div>
    </div>
  </div>
</nav>
