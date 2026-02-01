<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ一覧
        </h2>
    </x-slot>
    <div class="container">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- 検索フォーム -->
                <form method="GET" action="{{ url('/admin') }}" class="flex flex-wrap gap-2 items-center mb-4 search-form">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前 or メール"
                        class="border rounded px-2 py-1">

                    <select name="gender" class="border rounded px-2 py-1">
                        <option value="">性別（全て）</option>
                        <option value="1" @selected(request('gender') == '1')>男性</option>
                        <option value="2" @selected(request('gender') == '2')>女性</option>
                        <option value="3" @selected(request('gender') == '3')>その他</option>
                    </select>

                    <select name="category_id" class="border rounded px-2 py-1">
                        <option value="">種類（全て）</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>

                    <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-2 py-1">

                    <button type="submit" class="border rounded px-3 py-1 bg-gray-100">検索</button>
                    <a href="{{ url('/admin') }}" class="text-blue-600 underline">リセット</a>
                </form>

                <!-- テーブル -->
                <table class="w-full border border-gray-300">
                    <tr class="bg-gray-50">
                        <th class="border border-gray-300 p-2">名前</th>
                        <th class="border border-gray-300 p-2">メール</th>
                        <th class="border border-gray-300 p-2">種類</th>
                    </tr>

                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            <td class="border border-gray-300 p-2">{{ $contact->email }}</td>
                            <td class="border border-gray-300 p-2">{{ $contact->category->content }}</td>
                        </tr>
                    @endforeach
                </table>

                <div class="mt-4">
                    {{ $contacts->links() }}
                </div>

                <!-- モーダル -->
                <button type="button" class="js-open-modal mt-6 border rounded px-3 py-2 bg-gray-100">
                    モーダルを開く
                </button>

                <div class="modal" id="modal">
                    <div class="modal__content">
                        <p>ここがモーダルです</p>
                        <button type="button" class="js-close-modal border rounded px-3 py-1 bg-gray-100">閉じる</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

</x-app-layout>
