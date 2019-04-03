using System;
using System.Collections.Generic;
using System.Runtime.Serialization;
using System.Text;

namespace frontendApp.models
{
    public class UserModel
    {
        public UserModel()
        {
        }

        public UserModel(int id, string email, string username, string first_name, string last_name)
        {
            this.id = id;
            this.email = email;
            this.username = username;
            this.first_name = first_name;
            this.last_name = last_name;
        }

        public UserModel(int id, string email, string username, string password, string first_name, string last_name, string roles)
        {
            this.id = id;
            this.email = email;
            this.username = username;
            this.password = password;
            this.first_name = first_name;
            this.last_name = last_name;
            this.roles = roles;
        }

        public int id { get; set; }
        public string email { get; set; }
        public string username { get; set; }
        public string password { get; set; }
        public string first_name { get; set; }
        public string last_name { get; set; }
        public string roles { get; set; }
    }
}
