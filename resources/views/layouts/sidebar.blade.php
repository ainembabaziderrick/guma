<aside class="main-sidebar">
    <section class="sidebar">
        <!-- User Panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url(auth()->user()->foto ?? '/img/default-avatar.png') }}" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->level == 1)
            <!-- SUPER ADMIN -->
            <li class="header">MASTER DATA</li>
            <li>
                <a href="{{ route('employers.index') }}">
                    <i class="fa fa-building"></i> <span>Employers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('agents.index') }}">
                    <i class="fa fa-handshake-o"></i> <span>Agents</span>
                </a>
            </li>
            <li>
                <a href="{{ route('job-orders.index') }}">
                    <i class="fa fa-briefcase"></i> <span>Job Orders</span>
                </a>
            </li>

            <li class="header">RECRUITMENT</li>
            <li>
                <a href="{{ route('candidates.index') }}">
                    <i class="fa fa-users"></i> <span>Candidates</span>
                    @if($pendingCandidatesCount > 0)
                        <span class="badge bg-red">{{ $pendingCandidatesCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('screening.index') }}">
                    <i class="fa fa-check-square-o"></i> <span>Screening & Shortlist</span>
                </a>
            </li>

            <li class="header">DOCUMENTATION</li>
            <li>
                <a href="{{ route('medical.index') }}">
                    <i class="fa fa-medkit"></i> <span>Medical Exams</span>
                </a>
            </li>
                <li>
                    <a href="{{ route('police.index') }}">
                    <i class="fa fa-shield"></i> <span>Police Clearance</span>
                </a>
            </li>
            <li>
                <a href="{{ route('visa.index') }}">
                    <i class="fa fa-passport"></i> <span>Visa Processing</span>
                    @if(isset($pendingVisasCount) && $pendingVisasCount > 0)
                        <span class="badge badge-warning">{{ $pendingVisasCount }}</span>
                    @endif
                </a>
            </li>

            <li class="header">DEPLOYMENT</li>
            <li>
                <a href="{{ route('contract.index') }}">
                    <i class="fa fa-file-text-o"></i> <span>Contracts</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-plane"></i> <span>Deployments</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-globe"></i> <span>Post Deployment</span>
                </a>
            </li>

            <li class="header">FINANCE</li>
            <li>
                <a href="">
                    <i class="fa fa-money"></i> <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-file-invoice-o"></i> <span>Invoices</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-percent"></i> <span>Agent Commissions</span>
                </a>
            </li>

            <li class="header">REPORTS</li>
            <li>
                <a href="">
                    <i class="fa fa-bar-chart"></i> <span>Deployment Report</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-line-chart"></i> <span>Revenue Report</span>
                </a>
            </li>

            <li class="header">SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                </a>
            </li>

            @elseif(auth()->user()->level == 2)
            <!-- RECRUITMENT OFFICER -->
            <li class="header">RECRUITMENT</li>
            <li>
                <a href="">
                    <i class="fa fa-users"></i> <span>Candidates</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-user-plus"></i> <span>New Application</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-check-square-o"></i> <span>Screening</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-calendar"></i> <span>Interviews</span>
                </a>
            </li>

            <li class="header">JOB ORDERS</li>
            <li>
                <a href="">
                    <i class="fa fa-briefcase"></i> <span>Available Jobs</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-link"></i> <span>Match Candidates</span>
                </a>
            </li>

            @elseif(auth()->user()->level == 3)
            <!-- DOCUMENTATION OFFICER -->
            <li class="header">DOCUMENTATION</li>
            <li>
                <a href="">
                    <i class="fa fa-users"></i> <span>Approved Candidates</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-medkit"></i> <span>Medical Tracking</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-shield"></i> <span>Police Clearance</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-passport"></i> <span>Visa Processing</span>
                    @if(isset($pendingVisasCount) && $pendingVisasCount > 0)
                        <span class="badge badge-warning">{{ $pendingVisasCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-file-text-o"></i> <span>Generate Contracts</span>
                </a>
            </li>

            <li class="header">DEPLOYMENT</li>
            <li>
                <a href="">
                    <i class="fa fa-plane"></i> <span>Schedule Flights</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-list"></i> <span>Deployment List</span>
                </a>
            </li>
                    <i class="fa fa-list"></i> <span>Deployment List</span>
                </a>
            </li>

            @elseif(auth()->user()->level == 4)
            <!-- CANDIDATE / APPLICANT -->
            <li class="header">MY APPLICATION</li>
            <li>
                <a href="">
                    <i class="fa fa-user"></i> <span>My Profile</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-file-upload"></i> <span>My Documents</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-tasks"></i> <span>Application Status</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-briefcase"></i> <span>Available Jobs</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-file-text-o"></i> <span>My Contract</span>
                </a>
            </li>
            <li>
                <a href=" ">
                    <i class="fa fa-money"></i> <span>Payments</span>
                </a>
            </li>

            @endif
        </ul>
    </section>
</aside>