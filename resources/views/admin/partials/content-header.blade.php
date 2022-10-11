@foreach ($post_disable as $disable)
    <li class="nav-item">
        <a href="{{ route('posts.check', ['id'=>$disable->id]) }}" class="dropdown-item">
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
@foreach ($checked_posts as $checked)
<li class="nav-item">
    <a href="{{ route('posts.check', ['id'=>$checked->id]) }}" class="dropdown-item">
        <span class="image"><img src="{{ $checked->feature_image_path}}" /></span>
        <span>
            <span>{{ $checked->post_user->name }}</span>
            <span class="time">{{ date('d-m-Y', strtotime($checked->created_at)) }}</span>
        </span>
        <span class="message">
            {{ $checked->title }}
        </span>
    </a>
</li>
@endforeach