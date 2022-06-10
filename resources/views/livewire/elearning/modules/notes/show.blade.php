<div class="container">

    <div class="module-header">
        <div class="header-top">
            <h1>Relevée des notes</h1>
        </div>
        <a href="{{ route('profile', Auth::id()) }}" class="enseignant">
            <div class="enseignant-avatar">
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar">
            </div>
            <div class="enseignant-name">
                {{ ucfirst(Auth::user()->nom) }} {{ ucfirst(Auth::user()->prenom) }}
            </div>
        </a>
    </div>

    <div class="module-main">

        <table class="notes-table">
            @if ($s1)
                <thead>
                    <tr>
                        <th>
                            Semestre 1
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s1 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                @if ($s2)
                <thead>
                    <tr>
                        <th>
                            Semestre 2
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s2 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                @if ($s3)
                <thead>
                    <tr>
                        <th>
                            Semestre 3
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s3 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                @if ($s4)
                <thead>
                    <tr>
                        <th>
                            Semestre 4
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s4 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                @if ($s5)
                <thead>
                    <tr>
                        <th>
                            Semestre 5
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s5 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                @if ($s6)
                <thead>
                    <tr>
                        <th>
                            Semestre 6
                        </th>
                        <th>
                            Normale
                        </th>
                        <th>
                            Ratt
                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            Statu
                        </th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($s6 as $module)
                    <tr>
                        <td>
                            {{ $module->titre }}
                        </td>
                        <td>
                            {{ $module->noteN }}
                        </td>
                        <td>
                            {{ $module->noteR }}
                        </td>
                        <td>
                            {{ $module->session }}
                        </td>
                        <td>
                            @if ($module->noteN)
                                @if ($module->noteR)
                                    @if ($module->noteN < 10)
                                        @if ($module->noteR < 10)
                                            NV
                                        @else
                                            V
                                        @endif
                                    @endif
                                @else
                                    @if ($module->noteN < 10)
                                        R
                                    @else
                                        V
                                    @endif
                                @endif
                            @else
                                @if ($module->noteR)
                                    @if ($module->noteR < 10)
                                        NV
                                    @else
                                        V
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>


</div>
