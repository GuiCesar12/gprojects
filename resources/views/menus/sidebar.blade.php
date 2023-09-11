<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('index') }}">
            <span class="align-middle">GProjects</span>
        </a>

        <ul class="sidebar-nav">
            @switch(\Auth::user()->profile)
                @case(0)
                <li class="sidebar-header">
                    Administrator
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('users')}}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                    </a>
                </li>
   
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('sizes')}}">
                        <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Sizes</span>
                    </a>
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('contacts')}}">
                        <i class="align-middle" data-feather="phone"></i> <span class="align-middle">Contacts</span>
                    </a>
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('customers')}}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Customers</span>
                    </a>
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('products')}}">
                        <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Products</span>
                    </a>
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('status')}} ">
                        <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Status</span>
                    </a>
                </li>
                @case(1)
                <li class="sidebar-header">
                    Projects
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('projects')}}">
                        <i class="align-middle" data-feather="package"></i> <span class="align-middle">Projects</span>
                    </a>
                </li>

   
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('checklists')}}">
                        <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Checklists</span>
                    </a>
                </li>
    
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('notes')}}">
                        <i class="align-middle" data-feather="file"></i> <span class="align-middle">Notes</span>
                    </a>
                </li> --}}
                @case(2)
                <li class="sidebar-header">
                    Manager
                </li>
{{--         
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('reports')}}">
                        <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Resume projects</span>
                    </a>
                </li> --}}

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('dashboards')}}">
                        <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                @default
                    
            @endswitch()
        </ul>
    </div>
</nav>