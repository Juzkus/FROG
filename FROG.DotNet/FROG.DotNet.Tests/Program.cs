using System;

using FROG.DotNet;

namespace FROG.DotNet.Tests
{
    // TODO: change to Unit Test project?
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Running Tests.");

            TestPropertyParser();
        }

        static bool TestPropertyParser()
        {
            var props = PropertyParser.GetPropertiesFromFile("./Resources/test.props", '=');

            string name, greeting;
            props.TryGetValue("name", out name);
            props.TryGetValue("greeting", out greeting);

            Console.WriteLine(greeting + ", " + name);

            return true;
        }
    }
}
