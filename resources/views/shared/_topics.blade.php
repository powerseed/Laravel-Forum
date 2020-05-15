<ul class="list-group list-group-flush">
    @foreach($topics as $topic)
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-1 d-flex align-items-center justify-content-center">
                    <img src="{{ $topic->user->avatar }}" alt="" style="height: 50px; width: 50px; border-radius: 10px">
                </div>

                <div class="col-lg-10">
                    <a href="{{ route('topics.show', $topic) }}" style="font-size: 20px">{{ $topic->title }}</a>
                    <div class="mt-1">
                        <span class="mr-2">
                            <a href="{{ route('categories.show', $topic->category->id) }}">
                                <i class="far fa-folder"></i>
                                {{ $topic->category->name }}
                            </a>
                        </span>

                        <span class="mr-2">
                            <i class="far fa-user"></i>
                            {{ $topic->user->name }}
                        </span>

                        <span>
                            <i class="far fa-clock"></i>
                            {{ $topic->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <div class="col-lg-1 text-center align-self-center">
                    <span class="badge badge-secondary">{{ count($topic->replies) }}</span>
                </div>
            </div>
        </li>
    @endforeach
</ul>
