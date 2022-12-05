@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    @if (!empty($weight_log))
        <table class="table-auto mx-auto my-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">記録日時</th>
                    <th class="px-4 py-2">体重</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weight_log as $key => $val)
                    <tr>
                        <td class="border px-4 py-2">{{ $val['memoried_at'] }}</td>
                        <td class="border px-4 py-2">{{ $val['weight'] }}</td>
                        <td class="border px-4 py-2">
                            <a href="/weight/edit/?id={{ $val['id'] }}">
                                <button class="bg-gray-600 hover:bg-gray-500 text-white rounded px-4 py-2">編集</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="flex justify-center">
            データは未登録です。
        </div>
    @endif
@endsection

@include('./layouts/footer')

{{-- <script>
    // モーダルを表示。
function moveEdit(id) {
    window.location.href = '/weight/edit/?id=' + id;
}

</script> --}}