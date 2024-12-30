<div>
    <table class="min-w-full text-left text-sm font-dark text-surface ">
        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    Titulo</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    Marca</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    En Wordpress</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    En Chileautos</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    Vendido</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr wire:key="{{ $vehicle->id }}">
                    <td class="py-2 px-4 border-b border-gray-200">
                        <h5>{{ $vehicle->title }}</h5>
                        {{ $vehicle->especificaciones }}
                    </td>

                    <td class="py-2 px-4 border-b border-gray-200">{{ $vehicle->brand->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $vehicle->wp_id ? 'Si' : 'No' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $vehicle->ca_id ? 'Si' : 'No' }}</td>

                    <td class="py-2 px-4 border-b border-gray-200">{{ $vehicle->sold ? 'Si' : 'No' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a class="inline-block rounded border border-emerald-500 px-5 py-1 text-sm font-medium  text-white bg-emerald-400"
                            href="{{ route('vehicle.edit', $vehicle) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
