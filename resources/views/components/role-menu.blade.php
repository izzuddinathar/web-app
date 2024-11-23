@if($role === 'admin')
    <h4>Admin Menu</h4>
    <ul>
        <li><a href="{{ route('users.index') }}" class="text-blue-500">Manage Users</a></li>
        {{-- <li><a href="{{ route('menus.index') }}" class="text-blue-500">Manage Menus</a></li> --}}
    </ul>
@endif

{{-- @if($role === 'waiters')
    <h4>Waiters Menu</h4>
    <ul>
        <li><a href="{{ route('tables.index') }}" class="text-blue-500">Manage Tables</a></li>
        <li><a href="{{ route('reservations.index') }}" class="text-blue-500">Manage Reservations</a></li>
        <li><a href="{{ route('orders.index') }}" class="text-blue-500">Manage Orders</a></li>
    </ul>
@endif --}}
