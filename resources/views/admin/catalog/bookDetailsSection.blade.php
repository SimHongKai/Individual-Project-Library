<!-- Book Details -->
<div class="container">
    <!-- Upper Half -->
    <div class="row justify-content-center">
        <div class="card-book">
            <div class="row">
                <div class="innerLeft">
                    <img class="card-img-left" src="{{ asset('images/book_covers') }}/{{ $book->cover_img }}"/>
                </div>
                <div class="innerRight">
                    <div class="horizontal-card-footer"><br>
                        <span class="card-text-title">Book Title:</span>
                        <span class="card-text-title-content">{{ $book->title }}</span>
                        <br>
                        <span class="card-text-detail">ISBN-13 Number:</span>
                        <span class="card-text-detail-content">{{ $book->ISBN }}</span>
                        <br>
                        <span class="card-text-detail">Language:</span>
                        <span class="card-text-detail-content">{{ $book->language }}</span>
                        <br>
                        <span class="card-text-detail">Author:</span>
                        <span class="card-text-detail-content">{{ $book->author }}</span>
                        <br>
                        <span class="card-text-detail">Publication:</span>
                        <span class="card-text-detail-content">{{ $book->publication }}</span>
                        <br>
                        <span class="card-text-detail">Publication Date:</span>
                        <span class="card-text-detail-content">{{ $book->publication_date }}</span>
                        <br>
                        <span class="card-text-detail">Purchase Price:</span>
                        <span class="card-text-detail-content">{{ $book->price }}</span>
                        <br>
                        <span class="card-text-detail">Access Level:</span>
                        <span class="card-text-detail-content">{{ $book->access_level }}</span>
                        <br>
                        <span class="card-text-detail">Total Qty:</span>
                        <span class="card-text-detail-content">{{ $book->total_qty }}</span>
                        <span class="card-text-detail">Available Qty:</span>
                        <span class="card-text-detail-content">{{ $book->available_qty }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Lower Half -->
    <div class = "row">
        <p class="card-text-description">Description:</p>
    </div>
    <div class = "row">
        <p class="card-text-description-content">{{ $book->description }}</p>
    </div>
    <hr>
</div>