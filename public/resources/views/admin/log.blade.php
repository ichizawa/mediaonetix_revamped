@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center pt-2 pb-4 flex-wrap">
            <h1 class="fw-bold mb-3 mb-md-0">Activity Logs</h1>
        </div>

        <div class="card">
            <!-- Header with tabs and search bar -->
            <div class="card-header">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">

                    <!-- Tabs in one row, responsive -->
                    <ul class="nav nav-tabs flex-nowrap" id="activityTabs" role="tablist" style="overflow: hidden;">
                        <li class="nav-item flex-fill text-center" role="presentation">
                            <button class="nav-link active w-100" id="recent-tab" data-bs-toggle="tab"
                                data-bs-target="#recent" type="button" role="tab" aria-controls="recent"
                                aria-selected="true">Recent</button>
                        </li>
                        <li class="nav-item flex-fill text-center" role="presentation">
                            <button class="nav-link w-100" id="lastWeek-tab" data-bs-toggle="tab" data-bs-target="#lastWeek"
                                type="button" role="tab" aria-controls="lastWeek" aria-selected="false">Last Week</button>
                        </li>
                        <li class="nav-item flex-fill text-center" role="presentation">
                            <button class="nav-link w-100" id="lastMonth-tab" data-bs-toggle="tab"
                                data-bs-target="#lastMonth" type="button" role="tab" aria-controls="lastMonth"
                                aria-selected="false">Last Month</button>
                        </li>
                        <li class="nav-item flex-fill text-center" role="presentation">
                            <button class="nav-link w-100" id="allActivity-tab" data-bs-toggle="tab"
                                data-bs-target="#allActivity" type="button" role="tab" aria-controls="allActivity"
                                aria-selected="false">All Activity</button>
                        </li>
                    </ul>

                    <!-- Search bar -->
                    <form class="d-flex w-auto" role="search">
                        <input class="form-control" type="search" placeholder="Search activity..." aria-label="Search"
                            id="searchInput">
                    </form>
                </div>
            </div>


            <!-- Body with timeline content -->
            <div class="card-body" style="overflow-y: auto;">
                <div class="tab-content" id="activityTabsContent">
                    <!-- Recent Tab -->
                    <div class="tab-pane fade show active" id="recent" role="tabpanel" aria-labelledby="recent-tab">

                        <div class="fw-semibold mb-3">Today</div>

                        <div id="timelineContainer" class="position-relative ps-3">
                            <!-- Vertical Line -->
                            <div class="position-absolute top-0 bottom-0 start-1 bg-secondary" style="width: 2px;"></div>

                            <!-- Timeline Items -->
                            <div id="timelineItems">
                                <div class="timeline-item d-flex position-relative mb-4">
                                    <div class="timeline-dot bg-primary rounded-circle"
                                        style="width: 12px; height: 12px; position: absolute; left: -6px; top: 5px;"></div>
                                    <div class="ms-4 w-100 d-flex flex-wrap align-items-start justify-content-between">
                                        <div class="text-muted mb-2 me-3" style="min-width: 80px;">8:00 am</div>
                                        <div class="bg-light rounded p-3 flex-grow-1">
                                            <strong>Juan Dela Cruz - Client</strong><br>
                                            Added New Ticket - #0123<br>
                                            Added New User - #0123
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item d-flex position-relative mb-4">
                                    <div class="timeline-dot bg-primary rounded-circle"
                                        style="width: 12px; height: 12px; position: absolute; left: -6px; top: 5px;"></div>
                                    <div class="ms-4 w-100 d-flex flex-wrap align-items-start justify-content-between">
                                        <div class="text-muted mb-2 me-3" style="min-width: 80px;">9:00 am</div>
                                        <div class="bg-light rounded p-3 flex-grow-1">
                                            <strong>Ana Santos - Staff</strong><br>
                                            Edited Ticket - #0456
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item d-flex position-relative mb-4">
                                    <div class="timeline-dot bg-primary rounded-circle"
                                        style="width: 12px; height: 12px; position: absolute; left: -6px; top: 5px;"></div>
                                    <div class="ms-4 w-100 d-flex flex-wrap align-items-start justify-content-between">
                                        <div class="text-muted mb-2 me-3" style="min-width: 80px;">10:00 am</div>
                                        <div class="bg-light rounded p-3 flex-grow-1">
                                            <strong>Mark Lee - Admin</strong><br>
                                            Removed User - #0789
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-3">
                                <nav>
                                    <ul class="pagination mb-0" id="pagination"></ul>
                                </nav>
                            </div>

                        </div>
                    </div>

                    <!-- Last Week Tab -->
                    <div class="tab-pane fade" id="lastWeek" role="tabpanel" aria-labelledby="lastWeek-tab">
                        <div class="fw-semibold mb-3">Last Week</div>
                        <div class="position-relative ps-3">
                            <div class="position-absolute top-0 bottom-0 start-1 bg-secondary" style="width: 2px;"></div>

                            <div class="d-flex position-relative mb-4">
                                <div class="timeline-dot bg-primary rounded-circle"
                                    style="width: 12px; height: 12px; position: absolute; left: -6px; top: 5px;"></div>
                                <div class="ms-4 w-100 d-flex flex-wrap align-items-start justify-content-between">
                                    <div class="text-muted mb-2 me-3" style="min-width: 80px;">12:00 pm</div>
                                    <div class="bg-light rounded p-3 flex-grow-1">
                                        <strong>Juan Dela Cruz - Client</strong><br>
                                        Added New Ticket - #0123<br>
                                        Added New User - #0123
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Last Month -->
                    <div class="tab-pane fade" id="lastmonth" role="tabpanel" aria-labelledby="lastmonth-tab">
                        <div class="fw-semibold mb-3">Last Month</div>
                        <div class="position-relative ps-3">
                            <div class="position-absolute top-0 bottom-0 start-1 bg-secondary" style="width: 2px;"></div>
                        </div>
                    </div>

                    <!-- All Activity Tab -->
                    <div class="tab-pane fade" id="allActivity" role="tabpanel" aria-labelledby="allActivity-tab">
                        <div class="fw-semibold mb-3">All Activity</div>
                        <div class="position-relative ps-3">
                            <div class="position-absolute top-0 bottom-0 start-1 bg-secondary" style="width: 2px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const itemsPerPage = 2;
                const timelineContainer = document.getElementById('timelineItems');
                const pagination = document.getElementById('pagination');
                const searchInput = document.getElementById('searchInput');

                let allItems = Array.from(timelineContainer.children);
                let filteredItems = [...allItems];
                let currentPage = 1;

                function renderPagination(items) {
                    const pageCount = Math.ceil(items.length / itemsPerPage);
                    pagination.innerHTML = '';

                    for (let i = 1; i <= pageCount; i++) {
                        const li = document.createElement('li');
                        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                        li.addEventListener('click', function (e) {
                            e.preventDefault();
                            currentPage = i;
                            displayPage(filteredItems);
                            renderPagination(filteredItems);
                        });
                        pagination.appendChild(li);
                    }
                }

                function displayPage(items) {
                    timelineContainer.innerHTML = '';
                    const start = (currentPage - 1) * itemsPerPage;
                    const end = start + itemsPerPage;
                    const pageItems = items.slice(start, end);
                    pageItems.forEach(item => timelineContainer.appendChild(item));
                }

                function filterItems() {
                    const query = searchInput.value.toLowerCase();
                    filteredItems = allItems.filter(item =>
                        item.textContent.toLowerCase().includes(query)
                    );
                    currentPage = 1;
                    displayPage(filteredItems);
                    renderPagination(filteredItems);
                }

                // Initial render
                displayPage(filteredItems);
                renderPagination(filteredItems);

                // Search input listener
                searchInput.addEventListener('input', filterItems);
            });
        </script>



@endsection
    <script>
        function showNotif() {
            swal({
                title: "Work in progress",
                text: "This feature is not available yet",
                type: "info",
            });
        }
    </script>