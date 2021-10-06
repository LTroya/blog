<x-app-layout>

    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>

        <div class="mb-2 text-lg text-gray-500">
            {{$post->extract}}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gab-6">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2">

                <figure>
                    <img class="object-cover object-center w-full h-80" src="{{Storage::url($post->image->url)}}" alt="">
                </figure>

                <div class="mt-4 text-base text-gray-500">
                    {{$post->body}}
                </div>

            </div>

            {{-- Contenido Relacionado --}}
            <aside class="ml-2">
                <h1 class="mb-4 text-2xl font-bold text-gray-600">Más en {{ $post->category->name }}</h1>

                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{route('posts.show', $similar)}}">
                                <img class="object-cover object-center h-20 w-36" src="{{Storage::url($similar->image->url)}}" alt="">
                                <span class="text-gray-600">{{$similar->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>

</x-app-layout>
