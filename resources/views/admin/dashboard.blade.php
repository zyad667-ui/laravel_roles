@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
    <p class="text-lg font-semibold mb-4">Welcome, {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
    <div class="overflow-x-auto bg-white shadow rounded-lg p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->name === 'musiala' && $user->email === 'admin@admin.com')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Admin</span>
                        @else
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="rounded border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="this.form.submit()">
                                    <option value="seller" @if($user->roles->pluck('name')->first() === 'seller') selected @endif>Seller</option>
                                    <option value="customer" @if($user->roles->pluck('name')->first() === 'customer') selected @endif>Customer</option>
                                </select>
                            </form>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->email_verified_at)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif
    {{-- User table removed as requested --}}
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.role-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(form);
            const url = form.action;
            const method = 'PATCH';
            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': fd.get('_token'),
                    'Accept': 'application/json',
                },
                body: fd
            })
            .then(response => response.json().catch(() => response))
            .then(data => {
                if (data.status || data.message) {
                    // Show success message
                    let msg = data.status || data.message || 'Role updated successfully.';
                    let alert = document.createElement('div');
                    alert.className = 'mb-4 p-4 bg-green-100 text-green-800 rounded';
                    alert.innerText = msg;
                    form.closest('.max-w-7xl').insertBefore(alert, form.closest('.overflow-x-auto'));
                    setTimeout(() => alert.remove(), 3000);
                }
                // Optionally update the role cell
                const roleCell = form.closest('tr').querySelector('td:nth-child(3)');
                const select = form.querySelector('select[name="role"]');
                roleCell.textContent = select.options[select.selectedIndex].text;
            })
            .catch(() => {
                let alert = document.createElement('div');
                alert.className = 'mb-4 p-4 bg-red-100 text-red-800 rounded';
                alert.innerText = 'Failed to update role.';
                form.closest('.max-w-7xl').insertBefore(alert, form.closest('.overflow-x-auto'));
                setTimeout(() => alert.remove(), 3000);
            });
        });
    });
});
</script>
@endsection 