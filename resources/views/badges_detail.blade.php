<x-layout>
    <x-slot:title>Penjelasan Badge</x-slot:title>

    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal {
            background: rgb(41, 16, 58);
            padding: 24px;
            border-radius: 20px;
            max-width: 80%;
            width: 400px;
            position: relative;
        }

        .modal h2 {
            margin-top: 0;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 14px;
            font-size: 24px;
            color:#888;
            cursor: pointer;
        }

        .modal-close:hover {
            color: red;
        }
    </style>
    <h1 class="text-2xl font-bold text-purple-300 text-center">Daftar Badge</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        @foreach ($badges as $badge)
            <div class="flex flex-row sm:flex-col items-center sm:items-start bg-white/10 p-4 rounded-lg shadow text-white transition-all duration-300 hover:scale-105 hover:bg-white/20 hover:shadow-lg cursor-pointer group"
                 onclick="showModal(`{{ $badge->badge_name }}`, `{{ $badge->badge_desc }}`, `{{ asset('img/badge/' . $badge->badge_icon) }}`, `{{ $badge->badge_color }}`)">
                
                {{-- Gambar badge --}}
                <img src="{{ asset('img/badge/' . $badge->badge_icon) }}"
                     alt="{{ $badge->badge_name }}"
                     class="w-16 h-16 object-contain flex-shrink-0">

                {{-- Info badge --}}
                <div class="text-left ml-3 sm:ml-0 sm:mt-2">
                    <h2 class="text-default font-semibold group-hover:underline" style="color: {{ $badge->badge_color }}">
                        {{ $badge->badge_name }}
                    </h2>

                    <p class="text-xs text-slate-200 group-hover:text-white">
                        {{ $badge->badge_desc }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
        <div class="modal">
            <span class="modal-close" onclick="closeModal(event)">&times;</span>
            <img id="modalIcon" src="" alt="" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">
            <h1 id="modalTitle" style="color: #333; font-size: 1.5rem ;"></h1>
            <p id="modalDesc" style="color: #ffffff;"></p>
        </div>
    </div>

    <script>
        const overlay = document.getElementById('modalOverlay');
        const modalTitle = document.getElementById('modalTitle');
        const modalDesc = document.getElementById('modalDesc');
        const modalIcon = document.getElementById('modalIcon');

        function showModal(name, desc, iconUrl, color) {
            modalTitle.textContent = name;
            modalTitle.style.color = color;
            modalDesc.textContent = desc;
            modalIcon.src = iconUrl;

            overlay.style.display = 'flex';
        }

        function closeModal(event) {
            if (event.target === overlay || event.target.classList.contains('modal-close')) {
                overlay.style.display = 'none';
            }
        }
    </script>
</x-layout>
