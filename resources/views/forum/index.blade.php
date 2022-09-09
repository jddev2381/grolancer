@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-end mb-4">
        
        <div class="col-auto">
            <a href="/forum/create" class="btn btn-logo">
                <i class="fa-solid fa-comment-dots me-1"></i> New Topic
            </a>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-comments me-1"></i> Forum</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Replies</th>
                        <th class="text-center">Last Reply</th>
                    </tr>
                </thead>
                <tbody>
                    @if($topics->count() > 0)
                        @foreach($topics as $topic)
                            <tr>
                                <td><a href="/forum/{{ $topic->id }}">{{ $topic->title }}</a></td>
                                <td class="text-center">{{ $topic->user->username }}</td>
                                <td class="text-center">{{ $topic->comments->count() }}</td>
                                <td class="text-center">{{ $topic->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No topics found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection