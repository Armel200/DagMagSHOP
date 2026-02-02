@extends('admin.admin')

@section('title', 'Utilisateurs - DacMagSHOP')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Liste des utilisateurs</h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            {{-- @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif --}}

            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Photo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom complet</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date d'inscription</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="photo" class="w-10 h-10 rounded-full object-cover border border-gray-300">
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 flex items-center justify-center gap-3">
                                {{-- Bouton contacter --}}
                                <button onclick="openContactModal('{{ $user->id }}', '{{ $user->name }}')"
                                    class="px-3 py-1 bg-green-400 text-white rounded-lg text-xs hover:bg-green-500 transition">
                                    Contacter
                                </button>

                                {{-- Bouton bloquer --}}
                                <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 {{ $user->is_blocked ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-red-500 hover:bg-red-600' }} text-white rounded-lg text-xs transition">
                                        {{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($users->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    Aucun utilisateur inscrit pour le moment.
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL de contact --}}
    <div id="contactModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 w-11/12 sm:w-96 shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Contacter <span id="contactUserName"></span></h3>
            <form id="contactForm" method="POST">
                @csrf
                <!-- Sujet -->
                <input type="text" name="subject"
                    class="w-full border rounded-lg p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    placeholder="Sujet du message" required>
                <!-- Message -->
                <textarea name="message"
                    class="w-full border rounded-lg p-3 h-32 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                    placeholder="Écris ton message..." required></textarea>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeContactModal()"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const contactModal = document.getElementById("contactModal");
        const contactForm = document.getElementById("contactForm");
        const contactUserName = document.getElementById("contactUserName");

        function openContactModal(userId, userName) {
            contactUserName.textContent = userName;
            //  URL  pour l’envoi
            contactForm.action = "{{ url('admin/users') }}/" + userId + "/contact";
            contactModal.classList.remove("hidden");
            contactModal.classList.add("flex");
        }

        function closeContactModal() {
            contactModal.classList.add("hidden");
        }
    </script>
    </script>
@endsection
