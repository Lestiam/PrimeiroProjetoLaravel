<x-layout title="Séries">
    <a href="/series/criar">Adicionar </a>
    {{--o x-layout é um componente que está em resources/views/series/components/layout.blade.php--}}
    <ul>
        {{-- O ul é o que aparece dentro da tag slot no layout.blade.php--}}
        {{--o $series vem do SeriesController.php, que vem do método index()--}}
        {{--o $series é um array, então o foreach vai percorrer cada item do array e colocar dentro da variável $serie, que vai ser usada dentro do foreach para exibir cada item do array $series--}}
        @foreach ($series as $serie)
            {{--o @ vem do blade --}}
            <li>{{ $serie }}</li> {{-- essa sintaxe faz basicamente um ecko  --}}
        @endforeach
    </ul>
</x-layout>
