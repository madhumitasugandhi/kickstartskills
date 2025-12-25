{{-- SEARCH + ACTION --}}
<div class="glass-card mb-4">
    <div class="d-flex justify-content-between align-items-center gap-3">
        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control ps-5"
                   placeholder="Search fee structures...">
        </div>

        <button class="btn btn-success">
            <i class="bi bi-plus"></i> Create Fee Structure
        </button>
    </div>
</div>

{{-- FEE STRUCTURE CARD --}}
<div class="glass-card">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-start mb-3">

        <div class="d-flex gap-3">
            <div class="stat-icon info">
                <i class="bi bi-card-list"></i>
            </div>

            <div>
                <h6 class="mb-1">B.Tech Computer Science</h6>
                <small class="">Academic Year: 2024–25</small>
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
    <div class="row  small mb-3">
        <div class="col-md-3">
            <div>Total Fee</div>
            <strong class="text-white">₹1,80,000</strong>
        </div>
        <div class="col-md-3">
            <div>Students Enrolled</div>
            <strong class="text-white">245</strong>
        </div>
        <div class="col-md-3">
            <div>Installments</div>
            <strong class="text-white">4 payments</strong>
        </div>
        <div class="col-md-3">
            <div>Per Installment</div>
            <strong class="text-white">₹45,000</strong>
        </div>
    </div>

    {{-- COMPONENTS --}}
    <div class="small  mb-2">Fee Components</div>

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
            <div class="glass-card p-3 d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-2">
                    <span class="badge {{ $c['required'] ? 'bg-danger' : 'bg-info' }}"></span>
                    <span>{{ $c['name'] }}</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <span class="text-teal">{{ $c['amount'] }}</span>

                    @if($c['required'])
                        <span class="badge bg-danger-soft text-danger">Required</span>
                    @endif
                </div>

            </div>
        @endforeach

    </div>
</div>
