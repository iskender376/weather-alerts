<div>
    <button wire:click="subscribe" style="
    background: #dedede;
    padding: 10px;
    margin-bottom: 15px;
">Enable Notifications</button>
    <h2 class="text-xl font-bold mb-4">Manage Your Weather Alerts</h2>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="p-3 bg-green-500">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form for Adding Alert -->
    <form wire:submit.prevent="addAlert" class="mb-4">
        <input type="text" wire:model="city" placeholder="City" class="p-2 border rounded">
        <input type="number" wire:model="threshold_precipitation" placeholder="Precipitation Threshold" class="p-2 border rounded">
        <input type="number" wire:model="threshold_uv" placeholder="UV Threshold" class="p-2 border rounded">
        <button style="background: grey;" type="submit" class="p-2 bg-blue-500 text-white rounded">Add Alert</button>
    </form>

    <!-- List of Alerts -->
    <ul>
        @foreach ($alerts as $alert)
            <li class="p-2 border-b flex justify-between">
                <span>{{ $alert->city }} - Rain: {{ $alert->threshold_precipitation }}mm - UV: {{ $alert->threshold_uv }}</span>
                <button style="background: grey;padding: 5px;" wire:click="deleteAlert({{ $alert->id }})" class="text-red-500">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
