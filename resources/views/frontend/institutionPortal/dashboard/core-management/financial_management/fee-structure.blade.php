{{-- SEARCH + ACTION --}}
<div class="ui-card mb-4">
    <div class="d-flex justify-content-between align-items-center gap-3">
        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control"
                   placeholder="Search fee structures...">
        </div>

        <button class="btn btn-teal">
            <i class="bi bi-plus"></i> Create Fee Structure
        </button>
    </div>
</div>


{{-- FEE STRUCTURE CARD --}}
<div class="ui-card">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-start mb-3">

        <div class="d-flex gap-3">
            <div class="ui-avatar">
                <i class="bi bi-card-list"></i>
            </div>

            <div>
                <div class="ui-card-title">B.Tech Computer Science</div>
                <div class="ui-card-subtitle">Academic Year: 2024–25</div>
            </div>
        </div>

        {{-- KEBAB --}}
        <div class="student-actions">
            <button class="icon-btn kebab-btn">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu">
                <li><i class="bi bi-eye"></i> View</li>
                <li><i class="bi bi-pencil"></i> Edit</li>
                <li class="danger"><i class="bi bi-trash"></i> Delete</li>
            </ul>
        </div>
    </div>


    {{-- META INFO --}}
    <div class="row small mb-3">
        <div class="col-md-3">
            <div class="ui-muted">Total Fee</div>
            <strong>₹1,80,000</strong>
        </div>
        <div class="col-md-3">
            <div class="ui-muted">Students Enrolled</div>
            <strong>245</strong>
        </div>
        <div class="col-md-3">
            <div class="ui-muted">Installments</div>
            <strong>4 payments</strong>
        </div>
        <div class="col-md-3">
            <div class="ui-muted">Per Installment</div>
            <strong>₹45,000</strong>
        </div>
    </div>


    {{-- COMPONENTS --}}
    <div class="small ui-muted mb-2">Fee Components</div>

    <div class="d-flex flex-column gap-2">

        @php
            $components = [
                ['name'=>'Tuition Fee','amount'=>'₹1,20,000','required'=>true],
                ['name'=>'Lab Fee','amount'=>'₹30,000','required'=>true],
                ['name'=>'Library Fee','amount'=>'₹15,000','required'=>true],
                ['name'=>'Sports Fee','amount'=>'₹10,000','required'=>false],
                ['name'=>'Transport Fee','amount'=>'₹5,000','required'=>false],
            ];
        @endphp

        @foreach($components as $c)
            <div class="ui-box d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-2">
                    <span class="ui-badge">
                        {{ $c['required'] ? 'Required' : 'Optional' }}
                    </span>
                    <span>{{ $c['name'] }}</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <strong>{{ $c['amount'] }}</strong>
                </div>

            </div>
        @endforeach

    </div>

</div>