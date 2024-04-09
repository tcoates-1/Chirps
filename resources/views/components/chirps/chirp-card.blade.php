<div {{$attributes->merge(['class'=>"p-6 flex mb-4 bg-gradient-to-r from-blue-800 via-cyan-500 to-blue-400 shadow-lg rounded-lg border border-blue-600"]) }}>
    <a href="{{ route('profile.show', ['username' => $chirp->user->username]) }}">
        <img src="{{ $chirp->user->profile_image }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full mx-auto hover:scale-125" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
    </a>
    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('profile.show', ['username' => $chirp->user->username]) }}">
                    <span class="ml-2 text-white hover:font-bold">{{ $chirp->user->name }}</span>
                </a>
                <small class="ml-2 text-sm text-white">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                @unless ($chirp->created_at->eq($chirp->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                @endunless
            </div>
            @if ($chirp->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                {{ __('Edit') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endif
        </div>        
        <p class="mt-4 ml-2 p-1 px-3 bg-white text-2xl text-gray-900 rounded-lg inline-block">{{ $chirp->message }}</p>
        <!-- Display existing comments for the chirp -->
        @php
            $renderedCommentIds = [];
        @endphp
        
        <div id="{{ $chirp->id }}">
            @foreach ($chirp->parentComments as $parentComment)
                @if (!in_array($parentComment->id, $renderedCommentIds))
                    <div id="{{ $parentComment->id }}" class="comment text-lg bg-white mt-4 ml-5 p-1 items-center border border-blue-500 rounded-lg max-w-screen-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span>{{ $parentComment->comment }}</span>
                            </div>
                            @if(auth()->user() && auth()->user()->id === $parentComment->user_id)
                                <form method="POST" action="{{ route('comments.destroy', $parentComment) }}" data-id="{{ $parentComment->id }}"class="delete-comment flex items-center">
                                    @csrf
                                    <input type="hidden" name="comment_id" value="{{ $parentComment->id }}">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user() }}">
                                    <button type="submit" class="bg-red-500 text-white py-1 px-2 m-1 rounded hover:bg-red-800">Delete</button>
                                </form>
                            @endif
                        </div>
                        <input type="button" class="text-blue-500 hover:font-bold hover:cursor-pointer" id="replyButton" value="Reply" onclick="showForm(this)">
                        <form method="POST" action="{{ route('comments.store') }}" class="post-reply mt-4 lg:flex lg:items-center hidden" name="commentForm" style="display:none">
                            @csrf
                            <input type="hidden" name="chirp_id" value="{{ $chirp->id }}">
                            <input type="hidden" name="parent_id" value="{{ $parentComment->id }}">
                            <textarea name="comment" maxlength="255" class="w-full xl:w-1/4 p-1 border border-blue-500 rounded" placeholder="Reply..." required></textarea>
                            <button type="submit" class="mt-2 bg-white border border-blue-500 text-blue-500 font-bold py-2 px-4 rounded ml-2 hover:bg-gray-300">Reply</button>
                        </form>
                        @php
                            $renderedCommentIds[] = $parentComment->id;
                        @endphp
                        @if($parentComment->childComments->count() > 0)
                            @foreach ($parentComment->childComments as $childComment)
                                @if (!in_array($childComment->id, $renderedCommentIds))
                                    <div id="{{ $childComment->id }}" class="comment text-lg bg-white mt-4 ml-5 p-1 items-center border border-blue-500 rounded-lg max-w-screen-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span>{{ $childComment->comment }}</span>
                                            </div>
                                        @if(auth()->user() && auth()->user()->id === $childComment->user_id)
                                            <form method="POST" action="{{ route('comments.destroy', $childComment) }}" data-id="{{ $childComment->id }}"class="delete-comment flex items-center">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $childComment->id }}">
                                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user() }}">
                                                <button type="submit" class="bg-red-500 text-white py-1 px-2 m-1 rounded hover:bg-red-800">Delete</button>
                                            </form>
                                        @endif
                                        </div>
                                    </div>
                                @php
                                    $renderedCommentIds[] = $childComment->id;
                                @endphp
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
        <form method="POST" action="{{ route('comments.store') }}" class="post-comment mt-4 lg:flex lg:items-center" name="commentForm">
            @csrf
            <input type="hidden" name="chirp_id" value="{{ $chirp->id }}">
            <textarea name="comment" maxlength="255" class="w-full xl:w-1/4 p-1 border border-blue-500 rounded" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="mt-2 bg-white border border-blue-500 text-blue-500 font-bold py-2 px-4 rounded ml-2 hover:bg-gray-300">Comment</button>
        </form> 
    </div>    
</div>

<script>
    function addDeleteButtonEventListener(element){
        element.addEventListener("submit", async (event) => {
                event.preventDefault();
                const url = element.action
                const formData = new FormData(element)

                let response = await fetch(url, {
                    method: "POST",
                    body: formData
                });
                element.parentElement.parentElement.remove();
            })
    }
    function deleteComments(){
        let forms = document.querySelectorAll("form.delete-comment");
        forms.forEach(deleteButtonForm => {
            addDeleteButtonEventListener(deleteButtonForm);
        })
    }
    function addReplyButtonEventListener(element) {
        element.addEventListener("submit", async (event) => {
            event.preventDefault();
                let url = element.action;
                const formData = new FormData(element);

                let response = await fetch(url, {
                    method: "POST",
                    body: formData,
                })
                .then(response => {
                    return response.json();
                })
                .then((data) => {
                    let newest = document.createElement("div")
                    newest.classList.add("flex", "items-center", "justify-between")
                    newest.innerHTML = data.comment.comment;
                    let newButtonForm = document.createElement("form")
                    newButtonForm.classList.add("delete-comment")
                    newButtonForm.setAttribute("action", "/comments/" + data.comment.id)
                    newButtonForm.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="comment_id" value="${data.comment.id}">
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 m-1 rounded hover:bg-red-800">Delete</button>
                    `;
                    newest.appendChild(newButtonForm);
                    let newComment = document.createElement("div")
                    newComment.id = data.comment.id
                    newComment.classList.add("comment", "text-lg", "bg-white", "mt-4", "ml-5", "p-1", "items-center", "border", "border-blue-500", "rounded-lg", "max-w-screen-sm")
                    newComment.appendChild(newest)
                    document.getElementById(element.parent_id.value).appendChild(newComment);
                    element.reset();
                    addDeleteButtonEventListener(newButtonForm);
                })
        })
    }
    function renderComments(){
        let forms = document.querySelectorAll('form.post-comment');
        forms.forEach(commentButtonForm => {
            commentButtonForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                let url = commentButtonForm.action;
                const formData = new FormData(commentButtonForm);

                let response = await fetch(url, {
                    method: "POST",
                    body: formData,
                })
                .then(response => {
                    return response.json();
                })
                .then((data) => {
                    let newest = document.createElement("div")
                    newest.classList.add("flex", "items-center", "justify-between")
                    newest.innerHTML = data.comment.comment;
                    let newButtonForm = document.createElement("form")
                    newButtonForm.classList.add("delete-comment")
                    newButtonForm.setAttribute("action", "/comments/" + data.comment.id)
                    newButtonForm.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="comment_id" value="${data.comment.id}">
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 m-1 rounded hover:bg-red-800">Delete</button>
                    `;
                    newest.appendChild(newButtonForm);
                    let newReplyForm = document.createElement("form")
                    newReplyForm.classList.add("post-reply", "mt-4", "lg:flex", "lg:items-center")
                    newReplyForm.setAttribute("method", "POST")
                    newReplyForm.setAttribute("action", "/comments")
                    newReplyForm.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="parent_id" value="${data.comment.id}">
                        <input type="hidden" name="chirp_id" value="${data.comment.chirp_id}">
                        <textarea name="comment" maxlength="255" class="w-full xl:w-1/4 p-1 border border-blue-500 rounded" placeholder="Reply..." required></textarea>
                        <button type="submit" class="mt-2 bg-white border border-blue-500 text-blue-500 font-bold py-2 px-4 rounded ml-2 hover:bg-gray-300">Reply</button>
                    `;
                    newReplyForm.style.display = 'none'
                    let button = document.createElement("input")
                    button.type = "button"
                    button.classList.add("text-blue-500", "hover:font-bold", "hover:cursor-pointer")
                    button.value = "Reply"
                    button.addEventListener("click", function(){showForm(this);})
                    let newComment = document.createElement("div")
                    newComment.id = data.comment.id
                    newComment.classList.add("comment", "text-lg", "bg-white", "mt-4", "ml-5", "p-1", "items-center", "border", "border-blue-500", "rounded-lg", "max-w-screen-sm")
                    newComment.appendChild(newest)
                    newComment.appendChild(button)
                    newComment.appendChild(newReplyForm)
                    document.getElementById(commentButtonForm.chirp_id.value).appendChild(newComment);
                    commentButtonForm.reset();
                    addDeleteButtonEventListener(newButtonForm);
                    addReplyButtonEventListener(newReplyForm)
                })
            })
        })
    }
    function renderReplies(){
        let forms = document.querySelectorAll("form.post-reply");
        forms.forEach(replyButtonForm => {
            addReplyButtonEventListener(replyButtonForm);
        })
    }
    function showForm(button){
        let form = button.nextElementSibling;
        form.style.display = 'flex';
    }

</script>