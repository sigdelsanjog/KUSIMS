export default {
    items: [
        {
            title: true,
            name: "",
            class: "",
            wrapper: {
                element: "",
                attributes: {}
            }
        },
        {
            name: "Students",
            icon: "fas fa-user-graduate",
            children: [
                {
                    name: "List Student",
                    url: "/student",
                    icon: "icon-puzzle"
                },
                {
                    name: "Create Student",
                    url: "/student/create",
                    icon: "icon-puzzle"
                }
            ]
        },
        {
            name: "Profiles",
            url: "/charts",
            icon: "fas fa-users"
        },
        {
            name: "Manage",
            url: "/charts",
            icon: "fas fa-user-cog"
        },
        {
            name: "Settings",
            url: "/charts",
            icon: "fas fa-cogs"
        }
    ]
};
