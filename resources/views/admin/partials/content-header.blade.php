@foreach ($post_disable as $disable)
    <li class="nav-item">
        <a href="{{ route('posts.edit', ['id'=>$disable->id]) }}" class="dropdown-item">
            <span class="image"><img src="{{ $disable->feature_image_path}}" /></span>
            <span>
                <span>{{ $disable->post_user->name }}</span>
                <span class="time">{{ date('d-m-Y', strtotime($disable->created_at)) }}</span>
            </span>
            <span class="message">
                {{ $disable->title }}
            </span>
        </a>
    </li>
@endforeach